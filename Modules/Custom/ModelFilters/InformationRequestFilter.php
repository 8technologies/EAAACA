<?php 

namespace Modules\Custom\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class InformationRequestFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    // Filter 'user_id' OR 'user'
    public function user($id)
    {
        return $this->where('user_id', $id);
    }

    // Filter 'case_id' OR 'case'
    public function case($id)
    {
        return $this->where('case_id', $id);
    }
    public function case_id($id)
    {
        return $this->where('case_id', $id);
    }

    public function organization($id)
    {
        return $this->where('organization_id', $id);
    }
    public function organization_id($id)
    {
        return $this->where('organization_id', $id);
    }

    // Filter 'entity_status'
    public function entityStatus($status)
    {
        switch ($status) {
            case 'NEW':
                return $this
                    ->whereNull('information_requests.review_status_id')
                    ;
                break;

            case 'PENDING':
                return $this
                    ->where('information_requests.review_status_id', 2)
                    ;
                break;

            case 'AWAITING RESPONSE':
                return $this
                    ->where('information_requests.review_status_id', 1)
                    ->doesntHave('request_responses')
                    // ->whereRaw(
                    //     "(SELECT COUNT(*) FROM request_responses 
                    //     LEFT JOIN information_requests as xxxx on request_responses.information_request_id = xxxx.id
                    //     WHERE information_requests.id = xxxx.id  
                    //     ) = 0"
                    // )
                    ;
                break;

            case 'AWAITING FEEDBACK':
                return $this
                    ->where('information_requests.review_status_id', 1)
                    // ->has('request_responses')
                    ->whereNull('request_responses.feedback_status_id')
                    ->leftJoin('request_responses', 'request_responses.information_request_id', '=', 'information_requests.id')
                    ;
                break;

            case 'COMPLETED':
                return $this
                    ->where('information_requests.review_status_id', 1)
                    ->whereRaw(
                        "(SELECT COUNT(*) FROM request_responses 
                        LEFT JOIN information_requests as xxxx on request_responses.information_request_id = xxxx.id
                        WHERE information_requests.id = xxxx.id  
                        AND request_responses.feedback_status_id = 4 
                        ) > 0"
                    )
                    // ->has('request_responses')
                    // ->whereHas('request_responses', function($q){
                    //     $q->whereIn('request_responses.feedback_status_id', [4]);
                    // })
                    ;
                break;

            case 'MORE INFORMATION NEEDED':
                return $this
                    ->where('information_requests.review_status_id', 1)
                    ->whereRaw(
                        "(SELECT COUNT(*) FROM request_responses 
                        LEFT JOIN information_requests as xxxx on request_responses.information_request_id = xxxx.id
                        WHERE information_requests.id = xxxx.id  
                        AND request_responses.feedback_status_id = 4 
                        ) = 0"
                    )
                    ->whereRaw(
                        "(SELECT COUNT(*) FROM request_responses 
                        LEFT JOIN information_requests as xxxx on request_responses.information_request_id = xxxx.id
                        WHERE information_requests.id = xxxx.id  
                        AND request_responses.feedback_status_id = 5 
                        ) > 0"
                    )
                    ;
                break;
            
            default:
                # code...
                break;
        }
        return $this;
    }

}