<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pet_alerts".
 *
 * @property string $id
 * @property string $petId
 * @property string $userId
 * @property string $alertType
 * @property string $alertDate
 * @property string $alertFrequency
 * @property string $alertMedium
 *
 * @property Pets $pet
 * @property Users $user
 */
class PetAlerts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pet_alerts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['petId', 'userId', 'alertType', 'alertFrequency', 'alertDate'], 'required', 'message' => ''],
            [['petId', 'userId'], 'integer'],
            [['alertDate','vaccinationDate','startTime','reminder','Notes'], 'safe'],
            [['alertType', 'alertFrequency', 'alertMedium'], 'string', 'max' => 45],
            [['petId'], 'exist', 'skipOnError' => true, 'targetClass' => Pets::className(), 'targetAttribute' => ['petId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'petId' => 'Pet ID',
            'userId' => 'User ID',
            'alertType' => 'Alert Type',
            'alertDate' => 'Alert Date',
            'alertFrequency' => 'Alert Frequency',
            'alertMedium' => 'Alert Medium',
        ];
    }
    
    public function afterFind()
    {

    }

    public function getAlertDate() {
        return $this->alertDate = date('j M Y', strtotime($this->alertDate));
    }

    public function getAlertFrequency() {
        return Yii::$app->params["alertFrequency"][$this->alertFrequency];
    }

    public function getAlertType() {
        return Yii::$app->params["alertType"][$this->alertType];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPet()
    {
        return $this->hasOne(Pets::className(), ['id' => 'petId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

    /**
     * @param $search
     * @return PetAlerts
     */
    static function findModel($search) {
        $arraySearch = (is_array($search) ? $search : ["id" => $search]);
        if (!Yii::$app->user->can("admin")) {
            $arraySearch = array_merge($arraySearch, ["userId" => Yii::$app->user->identity->id]);
        }
        $find = PetAlerts::find()
            ->where($arraySearch);
        return $find->one();
    }


}
