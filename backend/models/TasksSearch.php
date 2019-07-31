<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tasks;

/**
 * TasksSearch represents the model behind the search form about `backend\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'status', 'position', 'user_id', 'adult_passengers', 'child_count', 'category_id', 'car_on_the_go', 'classification', 'loading_required_status', 'floor', 'lift', 'shipping_house_type', 'shipping_house_floor', 'shipping_house_lift', 'delivery_house_type', 'delivery_house_floor', 'delivery_house_lift', 'alert_email', 'view_performers'], 'integer'],
            [['payed_sum', 'offer_your_price', 'weight', 'width', 'length', 'height', 'shipping_house_area', 'delivery_house_area'], 'number'],
            [['date_cr', 'date_close', 'shipping_address', 'delivery_address', 'shipping_coordinate_x', 'shipping_coordinate_y', 'delivery_coordinate_x', 'delivery_coordinate_y', 'date_begin', 'promo_code', 'comment', 'flight_number_status', 'flight_number', 'meeting_with_sign_status', 'meeting_with_sign', 'car_model', 'car_mark', 'image', 'item_description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$id=0)
    {
        $query = Tasks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => ($id == 0) ? $this->type : $id,
            'payed_sum' => $this->payed_sum,
            'status' => $this->status,
            'date_cr' => $this->date_cr,
            'date_close' => $this->date_close,
            'position' => $this->position,
            'user_id' => $this->user_id,
            'date_begin' => $this->date_begin,
            'offer_your_price' => $this->offer_your_price,
            'adult_passengers' => $this->adult_passengers,
            'child_count' => $this->child_count,
            'category_id' => $this->category_id,
            'car_on_the_go' => $this->car_on_the_go,
            'weight' => $this->weight,
            'width' => $this->width,
            'length' => $this->length,
            'height' => $this->height,
            'classification' => $this->classification,
            'loading_required_status' => $this->loading_required_status,
            'floor' => $this->floor,
            'lift' => $this->lift,
            'shipping_house_type' => $this->shipping_house_type,
            'shipping_house_floor' => $this->shipping_house_floor,
            'shipping_house_lift' => $this->shipping_house_lift,
            'shipping_house_area' => $this->shipping_house_area,
            'delivery_house_type' => $this->delivery_house_type,
            'delivery_house_floor' => $this->delivery_house_floor,
            'delivery_house_lift' => $this->delivery_house_lift,
            'delivery_house_area' => $this->delivery_house_area,
            'alert_email' => $this->alert_email,
            'view_performers' => $this->view_performers,
        ]);

        $query->andFilterWhere(['like', 'shipping_address', $this->shipping_address])
            ->andFilterWhere(['like', 'delivery_address', $this->delivery_address])
            ->andFilterWhere(['like', 'shipping_coordinate_x', $this->shipping_coordinate_x])
            ->andFilterWhere(['like', 'shipping_coordinate_y', $this->shipping_coordinate_y])
            ->andFilterWhere(['like', 'delivery_coordinate_x', $this->delivery_coordinate_x])
            ->andFilterWhere(['like', 'delivery_coordinate_y', $this->delivery_coordinate_y])
            ->andFilterWhere(['like', 'promo_code', $this->promo_code])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'flight_number_status', $this->flight_number_status])
            ->andFilterWhere(['like', 'flight_number', $this->flight_number])
            ->andFilterWhere(['like', 'meeting_with_sign_status', $this->meeting_with_sign_status])
            ->andFilterWhere(['like', 'meeting_with_sign', $this->meeting_with_sign])
            ->andFilterWhere(['like', 'car_model', $this->car_model])
            ->andFilterWhere(['like', 'car_mark', $this->car_mark])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'item_description', $this->item_description]);

        return $dataProvider;
    }
}
