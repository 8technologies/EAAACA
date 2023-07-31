<?php

namespace Modules\Layout\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Layout\Entities\LayoutSection;
use Modules\Layout\Entities\LayoutRow;

class LayoutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', LayoutSection::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Layout/LayoutSection/Index', []);
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

        $data = LayoutSection::
                // with('model_permissions')
                withCount(['LayoutRows'])
                ->orderBy($sort_by, $sort_type)
                ->paginate($limit)
                ->withQueryString();

        // $data->each(function($model) {
        //     $model->append(['entity_permissions']);
        // });

        return $data;
    }



    /**
     * Silently add a section.
     * @param int $id
     * @return Renderable
     */
    public function addPageSection(Request $request, $id)
    {
        $entity = \Modules\Content\Entities\ContentPage::with(
            array_merge(
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships(),
            ),
        )->findOrFail($id);

        // if ($request->user()->cannot('create', LayoutSection::class)) {
        //     return response(['message' => 'You are not authorized to update this item'], 403);
        // }

        $data['position'] = $entity->layoutSections->count() + 1;
        $data['user_id'] = $request->user()->id;

        $entity->layoutSections()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Redirect::back()->with('success', 'Section Added');
    }

    /**
     * Update the specified sections.
     * @param int $id
     * @return Renderable
     */
    public function updatePageSections(Request $request)
    {
        $data = $request->all();
        $entity = null;

        if (count($data) > 0) {
            $ids = array_column($data, 'id');
            $items = LayoutSection::whereIn('id', $ids)->get();
            $entity = $items[0];

            foreach ($items as $key => $item) {
                $index = array_search($item->id, array_column($data, 'id'));
                $item->fill($data[$index])->save();
            }
        }

        // 
        if(checkAjaxJsonRequest($request))
        {
            return \Modules\Content\Entities\ContentPage::with(
                array_merge(
                    getPageLayoutSectionRelationships(),
                    getPageLayoutSectionTopRelationships(),
                ),
            )->findOrFail($entity->fieldable->id);
        }
        return Redirect::back()->with('success', 'Sections Updated');
    }



    /**
     * Silently add a Service Page section.
     * @param int $id
     * @return Renderable
     */
    public function addServiceSection(Request $request, $id)
    {
        $entity = \Modules\Content\Entities\ContentService::with(
            array_merge(
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships(),
            ),
        )->findOrFail($id);

        // if ($request->user()->cannot('create', LayoutSection::class)) {
        //     return response(['message' => 'You are not authorized to update this item'], 403);
        // }

        $data['position'] = $entity->layoutSections->count() + 1;
        $data['user_id'] = $request->user()->id;

        $entity->layoutSections()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Redirect::back()->with('success', 'Section Added');
    }

    /**
     * Update the specified sections.
     * @param int $id
     * @return Renderable
     */
    public function updateServiceSections(Request $request)
    {
        $data = $request->all();
        $entity = null;

        if (count($data) > 0) {
            $ids = array_column($data, 'id');
            $items = LayoutSection::whereIn('id', $ids)->get();
            $entity = $items[0];

            foreach ($items as $key => $item) {
                $index = array_search($item->id, array_column($data, 'id'));
                $item->fill($data[$index])->save();
            }
        }

        // 
        if(checkAjaxJsonRequest($request))
        {
            return \Modules\Content\Entities\ContentService::with(
                array_merge(
                    getPageLayoutSectionRelationships(),
                    getPageLayoutSectionTopRelationships(),
                ),
            )->findOrFail($entity->fieldable->id);
        }
        return Redirect::back()->with('success', 'Sections Updated');
    }


    /**
     * Silently add a Service Page section.
     * @param int $id
     * @return Renderable
     */
    public function addOurWorkSection(Request $request, $id)
    {
        $entity = \Modules\Content\Entities\ContentOurWork::findOrFail($id);

        // if ($request->user()->cannot('create', LayoutSection::class)) {
        //     return response(['message' => 'You are not authorized to update this item'], 403);
        // }

        $data['position'] = $entity->layoutSections->count() + 1;
        $data['user_id'] = $request->user()->id;

        $entity->layoutSections()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Redirect::back()->with('success', 'Section Added');
    }

    /**
     * Update the specified sections.
     * @param int $id
     * @return Renderable
     */
    public function updateOurWorkSections(Request $request)
    {
        $data = $request->all();
        $entity = null;

        if (count($data) > 0) {
            $ids = array_column($data, 'id');
            $items = LayoutSection::whereIn('id', $ids)->get();
            $entity = $items[0];

            foreach ($items as $key => $item) {
                $index = array_search($item->id, array_column($data, 'id'));
                $item->fill($data[$index])->save();
            }
        }

        // 
        if(checkAjaxJsonRequest($request))
        {
            return \Modules\Content\Entities\ContentOurWork::with(
                array_merge(
                    getPageLayoutSectionRelationships(),
                    getPageLayoutSectionTopRelationships(),
                ),
            )->findOrFail($entity->fieldable->id);
        }
        return Redirect::back()->with('success', 'Sections Updated');
    }





    /**
     * Silently add a section.
     * @param int $id
     * @return Renderable
     */
    public function addRow(Request $request, $id)
    {
        // if ($request->user()->cannot('create', $layoutRow)) {
        //     return response(['message' => 'You are not authorized to update this item'], 403);
        // }

        $entity = LayoutSection::findOrFail($id);

        $data['position'] = $entity->layoutRows->count() + 1;
        $data['user_id'] = $request->user()->id;

        $entity->layoutRows()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutSection::with(
                array_merge(
                    getLayoutSectionRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Row Added');
    }

    /**
     * Show the form for editing the specified resource.
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
            return LayoutSection::with(
                array_merge(
                    getLayoutSectionRelationships(),
                ),
            )->findOrFail($entity->fieldable_id);
        }
        return Redirect::back()->with('success', 'Rows Updated');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createFieldBlock(Request $request, $id)
    {
        if(checkAjaxJsonRequest($request))
        {
            return ['id' => $id];
        }
        return Inertia::render('Core/Field/FieldBlock/_FormCreateLayoutSection', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldBlock(Request $request, $id)
    {
        $entity = LayoutSection::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'block_id' => ['required'],
        ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $entity->fields->count() + 1;
        }

        $entity->fieldBlocks()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutSection::with(
                array_merge(
                    // ['user'],
                    getLayoutSectionRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Block Added');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', LayoutSection::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Layout/LayoutSection/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', LayoutSection::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        $entity = LayoutSection::create($data);
        $entity->uploadOrAttachMedia($request);

        $statusText = 'LayoutSection "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = LayoutSection::with(
            array_merge(
                getLayoutSectionRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Layout/LayoutSection/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = LayoutSection::with(
            array_merge(
                getLayoutSectionRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Layout/LayoutSection/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = LayoutSection::with(
            array_merge(
                getLayoutSectionRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        //
        $entity->uploadOrAttachMedia($request);
        $entity->fill($data)->save();

        $responseText = 'LayoutSection "' . $entity['name'] . '" has been updated';
        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $responseText);
        }
        return Redirect::back()->with('success', $responseText);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $entity = LayoutSection::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'LayoutSection "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

}
