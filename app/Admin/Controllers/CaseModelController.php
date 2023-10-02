<?php

namespace App\Admin\Controllers;

use App\Models\CaseModel;
use App\Models\Country;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use PHPUnit\Framework\Constraint\Count;

class CaseModelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cases';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CaseModel());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('administrator_id', __('Administrator id'));
        $grid->column('country_id', __('Country id'));
        $grid->column('title', __('Title'));
        $grid->column('status', __('Status'));
        $grid->column('content', __('Content'));

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
        $show = new Show(CaseModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('administrator_id', __('Administrator id'));
        $show->field('country_id', __('Country id'));
        $show->field('title', __('Title'));
        $show->field('status', __('Status'));
        $show->field('content', __('Content'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CaseModel());

        $form->tab('Case Basic Information', function ($form) {
            $u = Admin::user();
            if ($form->isCreating()) {
                $form->hidden('administrator_id')->default($u->id);
                $form->select('country_id', __('Country'))
                    ->options(Country::all()->pluck('name', 'id'))
                    ->rules('required');
                $form->text('title', __('Case Title'))->rules('required');
                $form->radioCard('status', __('Case Status'))
                    ->options([
                        'Investigation'   => 'Under Investigation',
                        'Closed' => 'Closed',
                    ])->rules('required');
                $form->quill('content', __('Case Details'));
            } else {
                $form->select('country_id', __('Country'))
                    ->options(Country::all()->pluck('name', 'id'))
                    ->disable(true);
                $form->display('title', __('Case Title'))->rules('required');
                $form->radio('status', __('Case Status'))
                    ->options([
                        'Investigation'   => 'Under Investigation',
                        'Closed' => 'Closed',
                    ])->disable(true);
                $form->quill('content', __('Case Details'))->disable(true);
            }
        })->tab('Contributors', function ($form) {
            $form->hasMany('contributors', 'Contributors', function (Form\NestedForm $form) {
                $form->select('administrator_id', __('Contributor'))
                    ->options(Administrator::all()->pluck('name', 'id'))
                    ->rules('required');
                $form->hidden('notified')->default('No');
            });
        })->tab('Attachments', function ($form) {
            $form->hasMany('attachments', function (Form\NestedForm $form) {
                $form->hidden('administrator_id')->default(Admin::user()->id);
                $form->text('name', __('Attachment Title'))->rules('required');
                $form->file('file', __('Attachment File'));
            });
        })->tab('Findings', function ($form) {
            $form->hasMany('findings', function (Form\NestedForm $form) {
                $form->hidden('administrator_id')->default(Admin::user()->id);
                $form->text('title', __('Title'))->rules('required');
                $form->quill('details', __('Details'))->rules('required');
            });
        });

        return $form;
    }
}
