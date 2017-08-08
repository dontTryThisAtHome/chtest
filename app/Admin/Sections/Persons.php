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
use Illuminate\Support\Collection;
/**
 * Class Posts
 *
 * @property \App\Model\Post $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Persons extends Section implements Initializable
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
    protected $title = 'Сотрудники';
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
            return \App\Person::count();})->setIcon('fa fa-user')->setTitle('Сотрудники');
    }
    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
       	$display = AdminDisplay::table()
       	->setColumns([
            AdminColumn::text('id', 'ID'),
            AdminColumn::text('name', 'Имя'),
            AdminColumn::text('surname', 'Фамилия'),
            AdminColumn::text('gender', 'Пол'),
            AdminColumn::text('wage', 'Зарплата'),
            AdminColumn::text('active','Активность'),
            AdminColumn::text('deptNames','Отделы'),
            AdminColumn::text('deptRelations','Отношения'),
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
            AdminFormElement::text('name', 'Имя')->required(), 
            AdminFormElement::text('surname', 'Фамилия')->required(), 
            AdminFormElement::checkbox('active', 'Активность')->required(), 
            AdminFormElement::number('wage', 'Зарплата')->required(),
            AdminFormElement::select('gender', 'Пол')
                ->setEnum(['мужской','женский'])
                ->setSortable(false)
                ->required(),
            AdminFormElement::multiselect('departments', "Отделы")
                ->setModelForOptions(\App\Department::class)
                ->setDisplay('name')
                ->required(),
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