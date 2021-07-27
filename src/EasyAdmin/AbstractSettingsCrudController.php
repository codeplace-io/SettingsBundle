<?php
declare(strict_types=1);

namespace Codeplace\SettingsBundle\EasyAdmin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

abstract class AbstractSettingsCrudController extends AbstractCrudController
{
    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->disable(Action::NEW, Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) {
            return $this->getIndexFields();
        } else {
            return $this->getFormFields();
        }
    }

    protected function getIndexFields(): array
    {
        return [
            TextField::new('name', 'Ustawienie'),
        ];
    }

    protected function getFormFields(): array
    {
        return [
            FormField::addPanel('Ustawienie'),
            TextField::new('name', 'Nazwa')
                ->setFormTypeOption('disabled', 'disabled'),

            FormField::addPanel('Parametry'),
        ];
    }
}
