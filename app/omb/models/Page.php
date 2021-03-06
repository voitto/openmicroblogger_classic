<?php

class Page extends Model {
  
  function Page() {
    
    // Page is a clone of the Post data model
    
    // only administrators can edit it
    
    // fields
    
    $this->char_field( 'title' );
    
    $this->text_field( 'body' );
    
    $this->text_field( 'summary' );
    
    $this->text_field( 'contributor' );
    $this->text_field( 'rights' );
    $this->text_field( 'source' );
    
    $this->char_field( 'uri' );
    $this->char_field( 'url' );
    
    $this->file_field( 'attachment' );
    
    $this->int_field( 'parent_id' );
    $this->int_field( 'profile_id' );
    $this->int_field( 'recipient_id' );
    
    $this->bool_field( 'local' );
    
    $this->time_field( 'created' );
    $this->time_field( 'modified' );
    
    $this->int_field( 'entry_id' );
    
    $this->auto_field( 'id' );
    
    // relationships
    
    // each record in posts HAS ONE record in entries
    
    $this->has_one( 'entry' );

    //$this->has_many( 'comments' );

    //$this->has_many( 'reviews' );
    
    $this->set_limit(10);
    
    // permissions
    
    $this->let_read(    'all:everyone' );
    
    $this->let_access(  'all:administrators' );
    
    $this->use_templates_from( 'posts' );
    
  }
  
}


