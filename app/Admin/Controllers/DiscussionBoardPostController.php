<?php

namespace App\Admin\Controllers;

use App\Models\DiscussionBoardPost;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DiscussionBoardPostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Discussion Board - Posts';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DiscussionBoardPost());
        $grid->disableBatchActions();

        $grid->column('created_at', __('Created'))
            ->display(function ($created_at) {
                return date('d-m-Y', strtotime($created_at));
            })->sortable();
        $grid->column('photo', __('Photo'))->lightbox(['width' => 60, 'height' => 60])
            ->sortable();
        $grid->column('topic', __('Topic'));

        $grid->column('administrator_id', __('Posted by'))
            ->display(function ($administrator_id) {
                if ($this->administrator == null)
                    return '';
                return $this->administrator->name;
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
        $show = new Show(DiscussionBoardPost::findOrFail($id));

        $show->field('topic', __('Topic'));
        $show->field('created_at', __('Created at'))->as(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        });
        $show->field('administrator_id', __('Posted by'))
            ->as(function ($administrator_id) {
                if ($this->administrator == null)
                    return '';
                return $this->administrator->name;
            });

        $show->field('photo', __('Photo'))->image();
        $show->field('details', __('Details'))->unescape(function ($details) {
            return $details;
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DiscussionBoardPost());

        $form->hidden('administrator_id', __('Administrator id'))->default(Admin::user()->id);
        $form->text('topic', __('Topic of discussion'))->rules('required');
        $form->image('photo', __('Photo'));
        $form->quill('details', __('Details'))->rules('required');

        return $form;
    }
}
