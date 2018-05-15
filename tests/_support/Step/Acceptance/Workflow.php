<?php

namespace Step\Acceptance;

use \AcceptanceTester as Tester;

class Workflow extends Tester
{
    public function navigateToWorkflow(
        NavigationBar $navigationBar,
        ListView $listView
    ) {
        $navigationBar->clickAllMenuItem('WorkFlow');
        $listView->waitForListViewVisible();
        $this->see('WORKFLOW');
    }

    public function selectWorkflowModule($module) {
        $this->selectOption('#flow_module', $module);
    }

    public function addCondition()
    {
        $this->click('#btn_ConditionLine');
    }


    public function setConditionModuleField($row, $module, $field)
    {
        $this->selectOption('#aow_conditions_module_path' . $row, $module);
        $this->selectOption('#aow_conditions_field' . $row, $field);
    }

    public function setConditionOperator($row, $operator, $type)
    {
        $this->selectOption('#aow_conditions_operator[' . $row . ']', $operator);
        $this->selectOption('#aow_conditions_value_type[' . $row . ']', $type);
    }

    public function setConditionOperatorDateTimeValue($row)
    {
        $now = new \DateTime();
        $valueDateDay =$now->format('d');
        $calendarButton = '#aow_conditions_valueSCRMLSQBR'.$row.'SCRMRSQBR_trigger';
        $calendarDialog = '#aow_conditions_valueSCRMLSQBR'.$row.'SCRMRSQBR_trigger_div';
        $this->click($calendarButton);
        $this->waitForElementVisible($calendarDialog, 10);
        $this->click('.today > .selector', $calendarDialog);
    }

    public function getLastConditionRowNumber()
    {
        return $this->executeJS('return document.querySelectorAll(\'[id ^= aow_conditions_body]\').length - 1;');
    }
}