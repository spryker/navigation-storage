<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Category\Persistence\Propel;

use Orm\Zed\Category\Persistence\Base\SpyCategory as BaseSpyCategory;
use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Category\Persistence\SpyCategoryAttribute;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Collection\ObjectCollection;

/**
 * Skeleton subclass for representing a row from the 'spy_category' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
abstract class AbstractSpyCategory extends BaseSpyCategory
{

    /**
     * @param int $idLocale
     *
     * @return SpyCategoryAttribute[]|ObjectCollection
     */
    public function getLocalisedAttributes($idLocale)
    {
        $criteria = new Criteria();
        $criteria->addAnd(
            SpyCategoryAttributeTableMap::COL_FK_LOCALE,
            $idLocale,
            Criteria::EQUAL
        );

        return $this->getAttributes($criteria);
    }

}