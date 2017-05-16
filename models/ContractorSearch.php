<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contractor;

/**
 * ContractorSearch represents the model behind the search form about `app\models\Contractor`.
 */
class ContractorSearch extends Contractor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_opf', 'legal_postcode', 'mailing_postcode'], 'integer'],
            [['name', 'email', 'phone', 'fax', 'legal_country', 'legal_region', 'legal_city', 'legal_street', 'legal_house', 'mailing_country', 'mailing_region', 'mailing_city', 'mailing_street', 'mailing_house', 'bank', 'bik', 'rs', 'ks', 'ogrn', 'kpp', 'inn'], 'safe'],
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
    public function search($params)
    {
        $query = Contractor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_opf' => $this->id_opf,
            'legal_postcode' => $this->legal_postcode,
            'mailing_postcode' => $this->mailing_postcode,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'legal_country', $this->legal_country])
            ->andFilterWhere(['like', 'legal_region', $this->legal_region])
            ->andFilterWhere(['like', 'legal_city', $this->legal_city])
            ->andFilterWhere(['like', 'legal_street', $this->legal_street])
            ->andFilterWhere(['like', 'legal_house', $this->legal_house])
            ->andFilterWhere(['like', 'mailing_country', $this->mailing_country])
            ->andFilterWhere(['like', 'mailing_region', $this->mailing_region])
            ->andFilterWhere(['like', 'mailing_city', $this->mailing_city])
            ->andFilterWhere(['like', 'mailing_street', $this->mailing_street])
            ->andFilterWhere(['like', 'mailing_house', $this->mailing_house])
            ->andFilterWhere(['like', 'bank', $this->bank])
            ->andFilterWhere(['like', 'bik', $this->bik])
            ->andFilterWhere(['like', 'rs', $this->rs])
            ->andFilterWhere(['like', 'ks', $this->ks])
            ->andFilterWhere(['like', 'ogrn', $this->ogrn])
            ->andFilterWhere(['like', 'kpp', $this->kpp])
            ->andFilterWhere(['like', 'inn', $this->inn]);

        return $dataProvider;
    }
}
