<?php

namespace App\Admin\Controllers;

use App\Models\NewsPost;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NewsPostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'News Posts';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new NewsPost());
        $grid->disableBatchActions();
        $grid->model()->orderBy('id', 'desc');

        $grid->column('photo', __('Photo'))->lightbox(['width' => 60, 'height' => 60]);
        $grid->column('created_at', __('Date'))
            ->display(function ($created_at) {
                return date('d-m-Y', strtotime($created_at));
            })->sortable();
        $grid->column('administrator_id', __('Posted By'))
            ->display(function ($administrator_id) {
                if ($this->administrator == null) {
                    return '-';
                }
                return $this->administrator->name;
            })->sortable();
        $grid->column('news_post_category_id', __('News Post Category'))
            ->display(function ($administrator_id) {
                if ($this->category == null) {
                    return '-';
                }
                return $this->category->name;
            })->sortable();



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(NewsPost::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('administrator_id', __('Administrator id'));
        $show->field('news_post_category_id', __('News post category id'));
        $show->field('title', __('Title'));
        $show->field('details', __('Details'));
        $show->field('photo', __('Photo'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new NewsPost());
        $form->hidden('administrator_id')->default(Admin::user()->id);

        //news_post_category_id
        $form->select('news_post_category_id', __('News Post Category'))
            ->options(\App\Models\NewsPostCategory::all()->pluck('title', 'id'));


        $form->text('title', __('Title'))->rules('required');
        $form->image('photo', __('Photo'));
        $form->quill('details', __('Details'))->rules('required');

        return $form;
    }
}
