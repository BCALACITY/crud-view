<?php
namespace CrudView\Listener\Traits;

use Cake\Event\Event;

trait IndexTypeTrait
{
    /**
     * beforeRender event
     *
     * @param \Cake\Event\Event $event Event.
     * @return void
     */
    public function beforeRenderIndexType(Event $event)
    {
        $indexTitleField = $this->_getIndexTitleField();
        $indexBodyField = $this->_getIndexBodyField();

        $controller = $this->_controller();
        $controller->set('indexType', $this->_getIndexType());
        $controller->set('indexBlogTitleField', $indexTitleField);
        $controller->set('indexBlogBodyField', $indexBodyField);
    }

    /**
     * Returns the index type to show on scaffolded view
     *
     * @return string
     */
    protected function _getIndexType()
    {
        $action = $this->_action();

        $indexType = $action->config('scaffold.index_type');
        if (empty($indexType)) {
            $indexType = 'table';
        }

        return $indexType;
    }

    /**
     * Returns the title field to show on scaffolded view
     *
     * @return string
     */
    protected function _getIndexTitleField()
    {
        $action = $this->_action();

        $field = $action->config('scaffold.index_title_field');
        if ($field === null) {
            $field = $action->config('scaffold.index_blog_title_field');
            if ($field !== null) {
                $this->deprecatedScaffoldKeyNotice(
                    'scaffold.index_blog_title_field',
                    'scaffold.index_title_field'
                );
            }
        }

        if (empty($field)) {
            $field = $this->_table()->displayField();
        }

        return $field;
    }

    /**
     * Returns the body field to show on scaffolded view
     *
     * @return string
     */
    protected function _getIndexBodyField()
    {
        $action = $this->_action();

        $field = $action->config('scaffold.index_body_field');
        if ($field === null) {
            $field = $action->config('scaffold.index_blog_body_field');
            if ($field !== null) {
                $this->deprecatedScaffoldKeyNotice(
                    'scaffold.index_blog_body_field',
                    'scaffold.index_body_field'
                );
            }
        }

        if (empty($field)) {
            $field = 'body';
        }

        return $field;
    }
}
