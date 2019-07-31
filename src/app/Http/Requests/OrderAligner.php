<?php

namespace App\Http\Requests;

use App\Dentist;
use App\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class OrderAligner
 * @package App\Http\Requests
 * @property int dentist_id
 * @property int patient_id
 * @property array data
 */
class OrderAligner extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $input = $this->all();

        $input['data']['produto'] = 1;

        // condicoes clinicas gerais
        if (isset($input['data']['condicoes_clinicas_gerais'])) {
            $input['data']['condicoes_clinicas_gerais'] = array_keys($input['data']['condicoes_clinicas_gerais']);
        } else {
            $input['data']['condicoes_clinicas_gerais'] = null;
        }

        // restricao de movimento dentário
        if (($input['restricao_movimento_dentario'] ?? '0') == '0') {
            $input['data']['restricao_movimento_dentario'] = null;
        }
        if (isset($input['data']['restricao_movimento_dentario'])) {
            $input['data']['restricao_movimento_dentario'] = array_keys($input['data']['restricao_movimento_dentario']);
        } else {
            $input['data']['restricao_movimento_dentario'] = null;
        }
        unset($input['restricao_movimento_dentario']);

        // attachments
        if (($input['attachments'] ?? '0') == '0') {
            $input['data']['attachments'] = null;
        }
        if (isset($input['data']['attachments'])) {
            $input['data']['attachments'] = array_keys($input['data']['attachments']);
        } else {
            $input['data']['attachments'] = null;
        }
        unset($input['attachments']);

        // sobremordida
        if (isset($input['data']['sobremordida']['detalhes_sobremordida'])) {
            $input['data']['sobremordida']['detalhes_sobremordida'] = array_keys($input['data']['sobremordida']['detalhes_sobremordida']);
        } else {
            $input['data']['sobremordida']['detalhes_sobremordida'] = null;
        }

        // diastemas
        $input['data']['diastemas']['sobrecorrecao_fechamento'] = ((bool) ((int) $input['data']['diastemas']['sobrecorrecao_fechamento'] ?? '0'));

        // data scan service
        $input['data']['scan_service'] = (bool) ((int) ($input['data']['scan_service'] ?? '1'));

        $this->replace($input);
    }

    public function messages()
    {
        return [
            'data.tratamento_arcada_superior.required' => 'Forma de tratamento para arcada superior obrigatória',
            'data.tratamento_arcada_inferior.required' => 'Forma de tratamento para arcada inferior obrigatória',
            'data.diastemas.correcao_apinhamento.superior.extracao_transversal.required' => 'Prioridade para extração transversal superior obrigatória',
            'data.diastemas.correcao_apinhamento.superior.vestibularizacao_incisivos.required' => 'Prioridade para vestibularização de incisivos superiores obrigatória',
            'data.diastemas.correcao_apinhamento.superior.dip_anterior.required' => 'Prioridade para DIP anterior superior obrigatória',
            'data.diastemas.correcao_apinhamento.inferior.extracao_transversal.required' => 'Prioridade para extração transversal inferior obrigatória',
            'data.diastemas.correcao_apinhamento.inferior.vestibularizacao_incisivos.required' => 'Prioridade para vestibularização de incisivos inferiores obrigatória',
            'data.diastemas.correcao_apinhamento.inferior.dip_anterior.required' => 'Prioridade para DIP anterior inferior obrigatória',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'patient_id' => ['required', Rule::in(Patient::all()->pluck('id')->toArray())],
            'dentist_id' => ['required', Rule::in(Dentist::approved()->get()->pluck('id')->toArray())],
            'data.observacoes_clinicas_objetivos' => 'required',
            'data.tratamento_arcada_superior' => 'required',
            'data.tratamento_arcada_inferior' => 'required',
            'data.diastemas.correcao_apinhamento.superior.extracao_transversal' => 'required',
            'data.diastemas.correcao_apinhamento.superior.vestibularizacao_incisivos' => 'required',
            'data.diastemas.correcao_apinhamento.superior.dip_anterior' => 'required',
            'data.diastemas.correcao_apinhamento.inferior.extracao_transversal' => 'required',
            'data.diastemas.correcao_apinhamento.inferior.vestibularizacao_incisivos' => 'required',
            'data.diastemas.correcao_apinhamento.inferior.dip_anterior' => 'required',
        ];
    }
}
