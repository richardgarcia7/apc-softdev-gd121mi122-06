<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $city_code
 * @property string $city_description
 * @property string $citycol
 * @property integer $province_id
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_code', 'city_description', 'citycol', 'province_id'], 'required'],
            [['province_id'], 'integer'],
            [['city_code', 'city_description', 'citycol'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_code' => 'City Code',
            'city_description' => 'City Description',
            'citycol' => 'Citycol',
            'province_id' => 'Province ID',
        ];
    }
}
