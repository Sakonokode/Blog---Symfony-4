<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 14:53
 */

namespace Blog\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * Class CategoryController
 * @package Alexandria\Controller
 * @Security("has_role('ROLE_ADMIN')")
 */
class CategoryController extends BaseAdminController
{

}