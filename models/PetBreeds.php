<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pet_breeds".
 *
 * @property string $id
 * @property string $name
 * @property integer $petTypeID
 *
 * @property PetBreedExp[] $petBreedExps
 * @property Users[] $users
 */
class PetBreeds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pet_breeds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'petTypeID'], 'required'],
            [['name'], 'string'],
            [['petTypeID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'petTypeID' => Yii::t('app', 'Pet Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPetBreedExps()
    {
        return $this->hasMany(PetBreedExp::className(), ['petBreedID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'userID'])->viaTable('pet_breed_exp', ['petBreedID' => 'id']);
    }

    /**
     * Finds all the breeds for the given petType, and formats them into a name - value array. If no petType is supplied, then all breeds are returned.
     *
     * @param null $breedType
     * @return array
     */
    static function getPetTypeForAutocomplete($breedType = null) {
        $breeds = PetBreeds::find();
        if ($breedType != null)
            $breeds->where(["petTypeID" => $breedType]);
        $breeds = $breeds->all();
        if (!empty($breeds) && is_array($breeds)) {
            /** @var PetBreeds $b */
            foreach ($breeds as &$b) {
                $b = $b->name; //['name' => $b->name, 'value' => $b->id];
            }
        }
        return $breeds;
    }

    /**
     * function findModel
     *
     * This finds one model based on the search given to it.
     *
     * @param array|string $search - Either an active query search, or a string representing the id of the row
     * @return PetBreed|null
     */
    static function findModel($search) {
        $arraySearch = (is_array($search) ? $search : ["id" => $search]);
        $find = PetBreeds::find()
            ->where($arraySearch);
        return $find->one();
    }

    /**
     *
     * Returns an array of all pet breeds formatted in a way that the tag input likes
     *
     * @param null $filter
     * @return array
     */

    static function petBreedsArray($filter = NULL) {

        if(is_null($filter)) {
            $search = PetBreeds::find()->select('id, name')->all();
        } else {
            $search = PetBreeds::find()->select('id, name')
                ->join('LEFT JOIN', 'pet_breed_exp', 'pet_breeds.id = pet_breed_exp.petBreedID')
                ->where(['userID' => $filter])->all();
        }

        $result=$search;

        return $result;
    }

}
