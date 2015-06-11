<?php
/**
* This class has been generated by TheliaStudio
* For more information, see https://github.com/thelia-modules/TheliaStudio
*/

namespace Diaporamas\Form;

use Diaporamas\Form\DiaporamaCreateForm;
use Diaporamas\Form\Type\DiaporamaIdType;

/**
 * Class DiaporamaUpdateForm
 * @package Diaporamas\Form
 */
class DiaporamaUpdateForm extends DiaporamaCreateForm
{
    const FORM_NAME = "diaporama_update";

    public function buildForm()
    {
        parent::buildForm();
        $this->formBuilder->add("id", DiaporamaIdType::TYPE_NAME);
    }
}
