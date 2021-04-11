<?php namespace Controllers;

use System\Core\Controller;
use Models\Entry;

class SearchController extends Controller {

    public function index()
    {
        if( !$this->request->has('datos') || $this->request->isEmpty('datos') ) 
            return redirect('');
        
        $data = $this->request->get('datos');
        $filters = $this->getRequestFilters();

        $model = new Entry;
        $entries = $model->searchEntries($filters, $data);
        return view('search/index', compact('data','entries'));
    }

    private function getRequestFilters()
    {
        $this_search = $this;
        $request_filters = array_filter($this->getFilters(), function ($key) use ($this_search) {
            return $this_search->request->has( $key );
        }) ;

        return count($request_filters) ? $request_filters : ['numero_entrada'];
    }
    
    private function getFilters()
    {
        return [
            'numero_entrada',
            'numero_consolidado',
            'numero_rastreo',
            'remitente',
            'destinatario'
        ];
    }
}

// Case insensitive
/**
 * COLLATE utf8_general_ci
 * LOWER(column) & LOWER(value)
 */