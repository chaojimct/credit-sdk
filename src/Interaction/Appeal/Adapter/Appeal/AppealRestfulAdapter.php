<?php
namespace Sdk\Interaction\Appeal\Adapter\Appeal;

use Marmot\Interfaces\INull;
use Sdk\Common\Adapter\CommonRestfulAdapter;

use Sdk\Common\Adapter\Traits\MapErrorsTrait;
use Sdk\Common\Adapter\Traits\FetchAbleRestfulAdapterTrait;
use Sdk\Common\Adapter\Traits\OperateAbleRestfulAdapterTrait;
use Sdk\Interaction\CommonInteraction\Adapter\CommonInteraction\CommonInteractionRestfulAdapterTrait;

use Sdk\Interaction\Appeal\Model\NullAppeal;
use Sdk\Interaction\Appeal\Translator\AppealRestfulTranslator;

class AppealRestfulAdapter extends CommonRestfulAdapter implements IAppealAdapter
{
    use FetchAbleRestfulAdapterTrait,
        OperateAbleRestfulAdapterTrait,
        CommonInteractionRestfulAdapterTrait,
        MapErrorsTrait;

    const MAP_ERROR = array(
        100001 => array(
            'realName' => REAL_NAME_FORMAT_INCORRECT,
            'cellphone' => INTERACTION_CELLPHONE_FORMAT_INCORRECT,
            'email' => EMAIL_FORMAT_INCORRECT,
            'title' => TITLE_FORMAT_INCORRECT,
            'content' => INTERACTION_CONTENT_FORMAT_INCORRECT,
            'replyContent' => INTERACTION_REPLY_CONTENT_FORMAT_INCORRECT,
            'staff' => STAFF_FORMAT_INCORRECT,
            'member' => MEMBER_FORMAT_INCORRECT,
            'data' => RESOURCE_DATA_FORMAT_INCORRECT,
            'organization' => ORGANIZATION_FORMAT_INCORRECT,
            'evidences' => INTERACTION_EVIDENCES_FORMAT_INCORRECT,
            '' => PARAMETER_INCORRECT
        ),
        100002 => RESOURCE_CAN_NOT_MODIFY,
        100004 => array(
            'staff' => STAFF_NOT_EXISTS,
            'member' => MEMBER_NOT_EXISTS,
            'data' => RESOURCE_DATA_NOT_EXISTS,
            'organization' => ORGANIZATION_NOT_EXISTS
        )
    );
    
    const SCENARIOS = [
        'APPEAL_LIST'=>[
            'fields' => [],
            'include' => 'staff,organization,member,data'
        ],
        'APPEAL_FETCH_ONE'=>[
            'fields'=>[],
            'include'=>'staff,organization,member,data'
        ]
    ];

    public function __construct(string $baseurl = '', array $headers = [])
    {
        parent::__construct(
            new AppealRestfulTranslator(),
            'interaction/appeals',
            $baseurl,
            $headers
        );
    }

    protected function getNullObject() : INull
    {
        return NullAppeal::getInstance();
    }

    protected function getAlonePossessMapErrors() : array
    {
        return self::MAP_ERROR;
    }

    public function scenario($scenario) : void
    {
        $this->scenario = isset(self::SCENARIOS[$scenario]) ? self::SCENARIOS[$scenario] : array();
    }

    protected function insertTranslatorKeys() : array
    {
        return array(
            'realName',
            'cellphone',
            'email',
            'title',
            'content',
            'evidences',
            'data',
            'member'
        );
    }

    protected function updateTranslatorKeys() : array
    {
        return array();
    }
}
