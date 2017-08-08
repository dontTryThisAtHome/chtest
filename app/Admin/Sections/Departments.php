<?php

namespace App\Admin\Sections;
use AdminColumn;
use AdminColumnFilter;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminDisplayFilter;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Section;
use SleepingOwl\Admin\Contracts\Initializable;
/**
 * Class Posts
 *
 * @property \App\Model\Post $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Departments extends Section implements Initializable
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;
    /**
     * @var string
     */
    protected $title = 'Отделы';
    /**
     * @var string
     */
    protected $alias;
    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation($priority = 500, function() {
            return \App\Department::count();})->setIcon('fa fa-building-o')->setTitle('Отделы');
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
       	$display = AdminDisplay::table()
       	->setColumns([
            AdminColumn::text('id', 'ID'),
            AdminColumn::text('name', 'Name'),
            AdminColumn::text('active','Активность'),
            AdminColumn::text('peopleNames','Сотрудники'),
        ])->paginate(20);
        return $display;
    }
    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Name')->required(),   
           	AdminFormElement::checkbox('active', 'Активность'),	
        ]);
    }
    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }
}