<?php

namespace Modules\Layout\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Layout\Entities\LayoutColumn;
use Modules\Layout\Entities\LayoutRow;
use Modules\Field\Entities\FieldTitle;
use Modules\Field\Entities\FieldText;
use Modules\Field\Entities\FieldLink;
use Modules\Field\Entities\FieldImage;
use Modules\Field\Entities\FieldHtml;
use Modules\Field\Entities\FieldBlock;

class LayoutColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', LayoutColumn::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Layout/LayoutColumn/Index', []);
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

        $data = LayoutColumn::
                with('layoutRow')
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
    public function createFieldTitle(Request $request, $id)
    {
        if(checkAjaxJsonRequest($request))
        {
            return ['id' => $id];
        }
        return Inertia::render('Core/Field/FieldTitle/Create', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldTitle(Request $request, $id)
    {
        $layoutColumn = LayoutColumn::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'title' => ['required'],
        ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $layoutColumn->fields->count() + 1;
        }

        $layoutColumn->fieldTitles()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutColumn::with(
                array_merge(
                    ['user'],
                    ['layoutRow'],
                    getLayoutColumnRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Title Added');
    }





    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createFieldLink(Request $request, $id)
    {
        if(checkAjaxJsonRequest($request))
        {
            return ['id' => $id];
        }
        return Inertia::render('Core/Field/FieldLink/Create', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldLink(Request $request, $id)
    {
        $layoutColumn = LayoutColumn::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'link' => ['required'],
        ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $layoutColumn->fields->count() + 1;
        }

        $layoutColumn->fieldLinks()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutColumn::with(
                array_merge(
                    ['user'],
                    ['layoutRow'],
                    getLayoutColumnRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Link Added');
    }





    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createFieldText(Request $request, $id)
    {
        if(checkAjaxJsonRequest($request))
        {
            return ['id' => $id];
        }
        return Inertia::render('Core/Field/FieldTitle/Create', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldText(Request $request, $id)
    {
        $layoutColumn = LayoutColumn::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'body' => ['required'],
        ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $layoutColumn->fields->count() + 1;
        }

        $layoutColumn->fieldTexts()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutColumn::with(
                array_merge(
                    ['user'],
                    ['layoutRow'],
                    getLayoutColumnRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Text Added');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createFieldImage(Request $request, $id)
    {
        if(checkAjaxJsonRequest($request))
        {
            return ['id' => $id];
        }
        return Inertia::render('Core/Field/FieldImage/Create', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldImage(Request $request, $id)
    {
        $layoutColumn = LayoutColumn::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // // Validate results
        // Validator::make($data, [
        //     // 'image' => ['required'],
        // ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $layoutColumn->fields->count() + 1;
        }

        $entity = $layoutColumn->fieldImages()->create($data);
        $entity->uploadAndAttachImage($request);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutColumn::with(
                array_merge(
                    ['user'],
                    ['layoutRow'],
                    getLayoutColumnRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Image Added');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createFieldHtml(Request $request, $id)
    {
        if(checkAjaxJsonRequest($request))
        {
            return ['id' => $id];
        }
        return Inertia::render('Core/Field/FieldHtml/Create', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldHtml(Request $request, $id)
    {
        $layoutColumn = LayoutColumn::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'body' => ['required'],
        ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $layoutColumn->fields->count() + 1;
        }

        $layoutColumn->fieldHtmls()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutColumn::with(
                array_merge(
                    ['user'],
                    ['layoutRow'],
                    getLayoutColumnRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Html Added');
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
        return Inertia::render('Core/Field/FieldBlock/Create', ['data' => ['id' => $id]]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function storeFieldBlock(Request $request, $id)
    {
        $layoutColumn = LayoutColumn::findOrFail($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'block_id' => ['required'],
        ])->validate();

        if (!isset($data['position'])) {
            $data['position'] = $layoutColumn->fields->count() + 1;
        }

        $layoutColumn->fieldBlocks()->create($data);

        if(checkAjaxJsonRequest($request))
        {
            return LayoutColumn::with(
                array_merge(
                    ['user'],
                    ['layoutRow'],
                    getLayoutColumnRelationships(),
                ),
            )->findOrFail($id);
        }
        return Redirect::back()->with('success', 'Block Added');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateColumnFields(Request $request)
    {
        $data = $request->all();
        $entity = null;

        // Update FieldTitle items
        $fieldTitles = array_values(array_filter($data, function($prop) {
            return $prop['model_name'] == 'FieldTitle';
        }));
        if (count($fieldTitles) > 0) {
            $ids = array_column($fieldTitles, 'id');
            $items = FieldTitle::whereIn('id', $ids)->get();
            $entity = $items[0];

            foreach ($items as $key => $item) {
                $entityData = $fieldTitles;
                $index = array_search($item->id, array_column($fieldTitles, 'id'));
                $item->fill($fieldTitles[$index])->save();
            }
        }

        // Update FieldText items
        $fieldTexts = array_values(array_filter($data, function($prop) {
            return $prop['model_name'] == 'FieldText';
        }));
        if (count($fieldTexts) > 0) {
            $ids = array_column($fieldTexts, 'id');
            $items = FieldText::whereIn('id', $ids)->get();
            $entity = $entity ? $entity : $items[0];

            foreach ($items as $key => $item) {
                $entityData = $fieldTexts;
                $index = array_search($item->id, array_column($fieldTexts, 'id'));
                $item->fill($fieldTexts[$index])->save();
            }
        }

        // Update FieldImage items
        $fieldImages = array_values(array_filter($data, function($prop) {
            return $prop['model_name'] == 'FieldImage';
        }));
        if (count($fieldImages) > 0) {
            $ids = array_column($fieldImages, 'id');
            $items = FieldImage::whereIn('id', $ids)->get();
            $entity = $entity ? $entity : $items[0];

            foreach ($items as $key => $item) {
                $entityData = $fieldImages;
                $index = array_search($item->id, array_column($fieldImages, 'id'));
                $item->fill($fieldImages[$index])->save();
            }
        }

        // Update FieldHtml items
        $fieldHtmls = array_values(array_filter($data, function($prop) {
            return $prop['model_name'] == 'FieldHtml';
        }));
        if (count($fieldHtmls) > 0) {
            $ids = array_column($fieldHtmls, 'id');
            $items = FieldHtml::whereIn('id', $ids)->get();
            $entity = $entity ? $entity : $items[0];

            foreach ($items as $key => $item) {
                $entityData = $fieldTexts;
                $index = array_search($item->id, array_column($fieldHtmls, 'id'));
                $item->fill($fieldHtmls[$index])->save();
            }
        }

        // Update FieldBlock items
        $fieldBlocks = array_values(array_filter($data, function($prop) {
            return $prop['model_name'] == 'FieldBlock';
        }));
        if (count($fieldBlocks) > 0) {
            $ids = array_column($fieldBlocks, 'id');
            $items = FieldBlock::whereIn('id', $ids)->get();
            $entity = $entity ? $entity : $items[0];

            foreach ($items as $key => $item) {
                $entityData = $fieldTexts;
                $index = array_search($item->id, array_column($fieldBlocks, 'id'));
                $item->fill($fieldBlocks[$index])->save();
            }
        }

        // 
        if(checkAjaxJsonRequest($request))
        {
            return $entity->fieldable;
        }
        return Redirect::back()->with('success', 'Positions Updated');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', LayoutColumn::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Layout/LayoutColumn/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', LayoutColumn::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();
        $entity = LayoutColumn::create($data);
        $entity->uploadOrAttachMedia($request);
        $statusText = 'LayoutColumn "' . $entity['name'] . '" has been created';

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
        $entity = LayoutColumn::with(
            array_merge(
                ['user'],
                ['layoutRow'],
                getLayoutColumnRelationships(),
            ),
        )->findOrFail($id)->append(['fields']);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Layout/LayoutColumn/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = LayoutColumn::with(
            array_merge(
                ['user'],
                ['layoutRow'],
                getLayoutColumnRelationships(),
            ),
        )->findOrFail($id);
        
        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Layout/LayoutColumn/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = LayoutColumn::with(
            array_merge(
                ['user'],
                ['layoutRow'],
                getLayoutColumnRelationships(),
            ),
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        $entity->uploadOrAttachMedia($request);
        $entity->fill($data)->save();
        $statusText = 'LayoutColumn "' . $entity['name'] . '" has been updated';

        // dd( checkAjaxJsonRequest($request) );

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
        $entity = LayoutColumn::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $parent_id = $entity->layout_row_id;
        $statusText = 'LayoutColumn "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response(
                LayoutRow::with(
                    array_merge(
                        ['user'],
                        getLayoutRowRelationships(),
                    ),
                )->findOrFail($parent_id)
            )->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}