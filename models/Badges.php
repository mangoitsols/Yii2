<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "badges".
 *
 * @property string $id
 * @property string $name
 * @property string $imageName
 * @property string $extraCss
 * @property string $description
 *
 * @property UsersBadges[] $usersBadges
 * @property Users[] $users
 */
class Badges extends \yii\db\ActiveRecord
{
    const COURSE = 7;//###PetCloud Accredited Sitter 
    const BACKGROUND = 2;//###POLICE CHECKED
    const IMAGEPATH = 'badges';
    
    const FIRSTAID = 3;
    const RELIABLE = 4;
    const RESPONSIVE = 5;
    const PREFERREDSITTER = 6;
    
    const VETNURSE = 8;
    const NDISTRAINING = 9;
    const RIGHTTOWORK = 10;
    const YELLOWCARD = 11;   
    const LICENCE = 12;   
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'badges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
            [['imageName', 'description'], 'string', 'max' => 255],
            [['extraCss'], 'string', 'max' => 1024],
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
            'imageName' => Yii::t('app', 'Image Name'),
            'extraCss' => Yii::t('app', 'Extra Css'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersBadges()
    {
        return $this->hasMany(UsersBadges::className(), ['badgeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'userId'])->viaTable('users_badges', ['badgeId' => 'id']);
    }

    public function getImagename($withUrl = false) {
        return ($withUrl ? Yii::getAlias("@uploadUrl") : "") . $this->imageName;
    }

    public function getHtmlNew($hasBadge = true) {
        $str = '<div>';
        $str .= '<img src="'.$this->getImagename(true).'" alt="'.$this->name.'" data-toggle="tooltip" data-placement="top" title="'.$this->name.'">';
        $str .= '</div>';
        return $str;
    }

    public function getHtml($hasBadge = true) {
        $str = '<div class="icon-item" data-toggle="tooltip" data-placement="top" title="'.$this->name.'" data-content="'.$this->name.'">';
        if (!$hasBadge)
            $str .= '<div class="img-overlay"></div>';
        $str .= '<img src="';
        $str .= $this->getImagename(true);
        $str .= '"></img></div>';
        return $str;
    }

    static function getAllActiveBadges() {
        return Badges::find()->all();
    }
}
