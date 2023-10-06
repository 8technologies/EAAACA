<?php

namespace App\Admin\Controllers;

use App\Models\InformationRequest;
use App\Models\Offence;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InformationRequestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Information Requests';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new InformationRequest());
        $grid->disableBatchActions();
        $conds = [];
        $u = Admin::user();
        if (!$u->isRole('admin')) {
            $grid->model()
                ->orderBy('id', 'Desc')
                ->where([
                    'sender_id' => Admin::user()->id,
                ])
                ->orWhere([
                    'receiver_id' => Admin::user()->id,
                ]);
        }
        $grid->model()->OrderBy('id', 'Desc');
        $grid->column('id', __('ID'))->sortable();
        /* $grid->column('organization_id', __('Organization'))
            ->display(function ($organization_id) {
                if ($this->organization == null)
                    return '-';
                return $this->organization->name;
            })->sortable(); */

        $grid->column('sender_id', __('Sender'))
            ->display(function ($sender_country_id) {
                if ($this->sender == null) {
                    return '-';
                }
                return $this->sender->name;
            })->sortable();
        $grid->column('receiver_id', __('Receiver'))
            ->display(function ($receiver_id) {
                if ($this->receiver == null) {
                    return '-';
                }
                return $this->receiver->name;
            })->sortable();
        $grid->column('cretaed_at', __('Request Date'))
            ->display(function ($cretaed_at) {
                return date('d-m-Y', strtotime($cretaed_at));
            })->sortable();
        $grid->column('request_reference_no', __('Request Reff No.'))->sortable();
        $grid->column('description_of_circumstances', __('Description of circumstances'))->sortable();
        $grid->column('purpose_for_information_request', __('Purpose for information request'))->hide();
        $grid->column('connection_btw_information_request', __('Connection btw information request'))->hide();
        $grid->column('identity_of_the_persons', __('Identity of the persons'))->hide();
        $grid->column('reasons_tobe_in_member_state', __('Reasons tobe in member state'))->hide();
        $grid->column('reason_for_request', __('Reason for request'))->hide();
        $grid->column('status', __('Status'))
            ->filter([
                'Pending' => 'Pending',
                'Waiting for response' => 'Waiting for response',
                'Halted' => 'Halted',
                'Completed' => 'Completed',
            ], 'Pending')
            ->label([
                'Pending' => 'warning',
                'Waiting for response' => 'info',
                'Halted' => 'danger',
                'Completed' => 'success',
            ], 'warning')
            ->sortable();

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
        $show = new Show(InformationRequest::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('organization_id', __('Organization id'));
        $show->field('member_state_id', __('Member state id'));
        $show->field('date_time_of_request', __('Date time of request'));
        $show->field('request_reference_no', __('Request reference no'));
        $show->field('case_id', __('Case id'));
        $show->field('type_of_crimes_investigated', __('Type of crimes investigated'));
        $show->field('description_of_circumstances', __('Description of circumstances'));
        $show->field('purpose_for_information_request', __('Purpose for information request'));
        $show->field('connection_btw_information_request', __('Connection btw information request'));
        $show->field('identity_of_the_persons', __('Identity of the persons'));
        $show->field('reasons_tobe_in_member_state', __('Reasons tobe in member state'));
        $show->field('reason_for_request', __('Reason for request'));
        $show->field('review_on', __('Review on'));
        $show->field('review_status_id', __('Review status id'));
        $show->field('review_notes', __('Review notes'));
        $show->field('review_by_id', __('Review by id'));
        $show->field('status_id', __('Status id'));
        $show->field('user_id', __('User id'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('receiver_id', __('Receiver id'));
        $show->field('receiver_country_id', __('Receiver country id'));
        $show->field('sender_id', __('Sender id'));
        $show->field('sender_country_id', __('Sender country id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new InformationRequest());

        $u = Admin::user();
        $form->hidden('sender_id', __('Sender'))->default($u->id);


        $form->select('receiver_id', __('Receiver Focal Point'))
            ->options(Administrator::toSelectArray())
            ->rules('required');

        $form->text('request_reference_no', __('Reference number of this request'))->rules('required');
        $form->radioCard('has_previous_reques', 'Has this request been made before?')
            ->options(['Yes' => 'Yes', 'No' => 'No'])
            ->when('Yes', function ($form) {
                $form->select('information_request_id', __('Select Previous Request'))
                    ->options(InformationRequest::toSelectArray())
                    ->rules('required');
            })->rules('required');
        $form->textarea('description_of_circumstances', __('Description of the circumstances in which the offence(s) was (were) committed, including the time, place an degree of participation in the offence(s) by the person who is the subject of the request for information or intelligence.'))
            ->help('Enter description of the circumstances in which the offence(s) was (were) committed here')
            ->rules('required');

        $form->checkbox('type_of_crimes_investigated', __('Crimes to investigate'))
            ->options(Offence::list())
            ->rules('required');
        $form->textarea('purpose_for_information_request', __('Identity(ies) (as far as known) of the person(s) being the main subject(s) of the criminal investigation or criminal intelligence operation underlying the request for information or intelligence'))->rules('required');
        $form->textarea('connection_btw_information_request', __("Connection between the purpose for which the information or intelligence is requested and the person who is the subject fo the information or intelligence."))->rules('required');
        $form->textarea('identity_of_the_persons', __('Reasons for believing that the information or intelligence is in the requested Member State'))->rules('required');
        $form->radio('reasons_tobe_in_member_state', __('Restrictions of the use of information contained in this request for purposes other than those for which it has been supplied of preventing an immediate and serious threat to public security.'))
            ->options([
                'Use granted' => 'Use granted',
                'Use granted, but do not mention the information provider' => 'Use granted, but do not mention the information provider',
                'Do not use without authorisation of the information provider' => 'Do not use without authorisation of the information provider',
                'Do not use' => 'Do not use'
            ])
            ->stacked()
            ->rules('required');


        return $form;
    }
}
