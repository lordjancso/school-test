<?php

namespace AppBundle\Twig;

use AppBundle\Entity\StudyGroup;
use Doctrine\Common\Collections\Collection;

class StudyGroupExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('renderStudyGroups', array($this, 'renderStudyGroups'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    public function renderStudyGroups(Collection $study_groups)
    {
        $names = array();

        /** @var StudyGroup $study_group */
        foreach ($study_groups as $study_group) {
            $names[] = $study_group->getName();
        }

        if (count($names) > 2) {
            $response = $names[0] . ', ' . $names[1] . ' and <span>' . (count($names) - 2) . ' more</span>';
        } else {
            $response = implode(', ', $names);
        }

        return $response;
    }

    public function getName()
    {
        return 'study_group_extension';
    }
}
