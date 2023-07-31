<?php

namespace Modules\Layout\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Layout\Entities\LayoutRow;
use Modules\Layout\Entities\LayoutColumn;

class LayoutRowController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', LayoutRow::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Layout/LayoutRow/Index', []);
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

        $data = LayoutRow::
                withCount(['layoutColumns'])
                ->orderBy($sort_by, $sort_type)
                ->paginate($limit)
                ->withQueryString();

        // $data->each(function($model) {
        //     $model->append(['entity_permissions']);
        // });

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateColumns(Request $request)
    {
        $data = $request->all();
        $entity = null;

        if (count($data) > 0) {
            $ids = array_column($data, 'id');
            $items = LayoutColumn::whereIn('id', $ids)->get();
            $entity = $items[0];

            foreach ($items as $key => $item) {
                $index = array_search($item->id, array_column($data, 'id'));
                $item->fill($data[$index])->save();
            }
        }

        // 
        if(checkAjaxJsonRequest($request))
        {
            return LayoutRow::with(
                array_merge(
                    ['user'],
                    getLayoutRowRelationships(),
                ),
            )->findOrFail($entity->layout_row_id);
        }
        return Redirect::back()->with('success', 'Columns Updated');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function addColumn(Request $request, $id)
    {
        $layoutRow = LayoutRow::findOrFail($id);

        // if ($request->user()->cannot('create', $layoutRow)) {
        //     return response(['message' => 'You are not authorized to update this item'], 403);
        // }
        
        $data = $request->all();
        $data['width'] = 'col-md-12';
        $data['position'] = $layoutRow->layoutColumns->count() + 1;
        (int)$columns = isset($data['columns']) ? $data['columns'] : null;
        
        if ( $columns ) {
            $defaultPosition = $data['position'];
            $data['width'] = 'col-md-' . 12/$columns;

            for ($i=0; $i < $columns; $i++) { 
                $data['position'] = ($i == 0) ? $defaultPosition : $defaultPosition + $i; 
                $layoutRow->layoutColumns()->create($data);
            }
        } else {
            $layoutRow->layoutColumns()->create($data);
        }        

        if(checkAjaxJsonRequest($request))
        {
            return LayoutRow::with(
                array_merge(
                    ['user'],
                    getLayoutRowRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Column Added');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', LayoutRow::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Layout/LayoutRow/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', LayoutRow::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        // // Validate results
        // Validator::make($data, [
        //     'name' => ['required', 'min:3', 'max:30'],
        // ])->validate();

        $entity = LayoutRow::create($data);
        $statusText = 'LayoutRow "' . $entity['name'] . '" has been created';

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
        $entity = LayoutRow::with(
            array_merge(
                ['user'],
                getLayoutRowRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Layout/LayoutRow/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = LayoutRow::with(
            array_merge(
                ['user'],
                getLayoutRowRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Layout/LayoutRow/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = LayoutRow::with(
            array_merge(
                ['user'],
                getLayoutRowRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        $entity->fill($data)->save();
        $statusText = 'LayoutRow "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $entity = LayoutRow::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'LayoutRow "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
