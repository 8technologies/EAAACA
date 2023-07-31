<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Content\Entities\ContentPage;
use Modules\Layout\Entities\LayoutRow;

class ContentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', ContentPage::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Content/Page/Index', []);
        }
    }

    /**
     * Fetch resources from the database.
     *
     * @return \$data
     */
    public function getData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = ContentPage::
            with('media', 'user')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
                ->withQueryString();

        return $data;
    }

    /**
     * Silently add a section.
     * @param int $id
     * @return Renderable
     */
    public function addContentSection(Request $request, $id)
    {
        // if ($request->user()->cannot('create', $layoutRow)) {
        //     return response(['message' => 'You are not authorized to update this item'], 403);
        // }

        $contentPage = ContentPage::findOrFail($id);

        $data['position'] = $contentPage->layoutRows->count() + 1;
        $data['field_name'] = 'content_section';
        $data['user_id'] = $request->user()->id;

        $contentPage->layoutRows()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return ContentPage::with(
                array_merge(
                    ['user'],
                    getPageLayoutSectionRelationships(),
                    getPageLayoutSectionTopRelationships()
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Section Added');
    }

    /**
     * Update the specified rows.
     * @param int $id
     * @return Renderable
     */
    public function updateRows(Request $request)
    {
        $data = $request->all();
        $entity = null;

        if (count($data) > 0) {
            $ids = array_column($data, 'id');
            $items = LayoutRow::whereIn('id', $ids)->get();
            $entity = $items[0];

            foreach ($items as $key => $item) {
                $index = array_search($item->id, array_column($data, 'id'));
                $item->fill($data[$index])->save();
            }
        }

        // 
        if(checkAjaxJsonRequest($request))
        {
            return ContentPage::with(
                array_merge(
                    ['user'],
                    getPageLayoutSectionRelationships(),
                    getPageLayoutSectionTopRelationships()
                ),
            )->findOrFail($entity->fieldable->id);
        }
        return Redirect::back()->with('success', 'Rows Updated');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', ContentPage::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Content/Page/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', ContentPage::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }
        
        $data = $request->all();

        // Validate results
        Validator::make($data, [
            'title' => ['required', 'min:3', 'max:255'],
        ])->validate();

        $entity = ContentPage::create($data);
        $entity->updateRelatedEntities($request);
        $statusText = 'Page "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.pages.edit', [$entity->id])->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = ContentPage::with(
            array_merge(
                ['media'],
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships()
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Page/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = ContentPage::with(
            array_merge(
                ['user', 'media'],
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships()
            ),
        )->findOrFail($id)
        ->append('image_url');

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Page/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = ContentPage::with(
            array_merge(
                ['user'],
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships()
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'title' => ['required', 'min:3', 'max:255'],
        ])->validate();

        $entity->fill($data)->save();
        $entity->updateRelatedEntities($request);
        $statusText = 'Page "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect($entity['entity_links']['url'])->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $entity = ContentPage::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Page "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.pages.index')->with('success', $statusText);
    }
}
