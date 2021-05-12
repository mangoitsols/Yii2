<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "rtag.company_settings".
 *
 * @property int $id
 * @property int $company_id
 * @property int $tracking_enabled
 * @property int $chat_enabled
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CarmailproductionCompanies $company
 */
class CompanySettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rtag.company_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'tracking_enabled', 'chat_enabled'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'tracking_enabled' => Yii::t('app', 'Tracking Enabled'),
            'chat_enabled' => Yii::t('app', 'Chat Enabled'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'value'=> new Expression("NOW()")
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(CarmailproductionCompanies::className(),['id'=>'company_id']);
    }
}
