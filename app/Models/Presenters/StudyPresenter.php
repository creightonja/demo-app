<?php

namespace App\Models\Presenters;

trait StudyPresenter
{
    public function __construct(array $attributes = []) {
        // to force 'virtual' accessor attributs to show up in Json
        $this->appends =  ['showUri', 'actions', 'view_link_html'];

        parent::__construct($attributes);
    }

    public function getShowUriAttribute()
    {
        return route('sponsors.studies.show', [$this->sponsor, $this]);
    }
    public function getEditUriAttribute() {
        return route('sponsors.studies.edit', [$this->sponsor, $this]);    	
    }

    public function getViewLinkHtmlAttribute() {
        return "<a title='View Study' href='{$this->showUri}'>$this->name</a>";
    }

    public function getActionsAttribute() {
    	return [
    		'view' => [
		    			'uri' => $this->show_uri,
		    			'icon' => 'fa-eye',
    				],
    		'edit' => [
		    			'uri' => $this->edit_uri,
		    			'icon' => 'fa-edit',    		
	    			]

    	];
    }

}
