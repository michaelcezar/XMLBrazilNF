<?php

class xmlBrazilNF {
    public $pathFile;
    public $optionType;

    public function getXMLFile(){
        if($this->xmlFile = simplexml_load_file($this->pathFile)){
            return json_encode($this->getXMLInfo());//json_encode($this->getXMLInfo());
        } else {
            return json_encode( ['success' => false, 'error' => 'Não foi possível abrir o arquivo'] );
        }
    }

    public function getXMLInfo(){
        $nfe        = [];
        $duplicatas = [];
        $produtoss  = [];
        foreach($this->xmlFile->NFe as $key => $item){
            $nfe = array(
                'versao'                              => (string) trim($item->infNFe->attributes()->versao),
                'id_nf'                               => (string) trim($item->infNFe->attributes()->Id),
                'nf'                                  => (string) trim($item->infNFe->ide->nNF),
                'cnf'                                 => (string) trim($item->infNFe->ide->cNF),
                'tipo_nf'                             => (string) trim($item->infNFe->ide->tpNF),
                'serie_nf'                            => (string) trim($item->infNFe->ide->serie),
                'data_emissao'                        => (string) trim($item->infNFe->ide->dhEmi),
                'emissor_cnpj'                        => (string) trim($item->infNFe->emit->CNPJ),
                'emissor_nome'                        => (string) trim($item->infNFe->emit->xNome),
                'emissor_inscricao_estadual'          => (string) trim($item->infNFe->emit->IE),
                'emissor_inscricao_municipal'         => (string) trim($item->infNFe->emit->IM),
                'emissor_cnae'                        => (string) trim($item->infNFe->emit->CNAE),
                'emissor_crt'                         => (string) trim($item->infNFe->emit->CRT),
                'emissor_endereco_logradouro'         => (string) trim($item->infNFe->emit->enderEmit->xLgr),
                'emissor_endereco_numero'             => (string) trim($item->infNFe->emit->enderEmit->nro),
                'emissor_endereco_bairro'             => (string) trim($item->infNFe->emit->enderEmit->xBairro),
                'emissor_endereco_cod_municipio'      => (string) trim($item->infNFe->emit->enderEmit->cMun),
                'emissor_endereco_municipio'          => (string) trim($item->infNFe->emit->enderEmit->xMun),
                'emissor_endereco_uf'                 => (string) trim($item->infNFe->emit->enderEmit->UF),
                'emissor_endereco_cep'                => (string) trim($item->infNFe->emit->enderEmit->CEP),
                'emissor_endereco_cod_pais'           => (string) trim($item->infNFe->emit->enderEmit->cPais),
                'emissor_endereco_pais'               => (string) trim($item->infNFe->emit->enderEmit->xPais),
                'emissor_fone'                        => (string) trim($item->infNFe->emit->enderEmit->fone),
                'destinatario_cnpj'                   => (string) trim($item->infNFe->dest->CNPJ),
                'destinatario_nome'                   => (string) trim($item->infNFe->dest->xNome),
                'destinatario_inscricao_estadual'     => (string) trim($item->infNFe->dest->IE),
                'destinatario_endereco_logradouro'    => (string) trim($item->infNFe->dest->enderDest->xLgr),
                'destinatario_endereco_numero'        => (string) trim($item->infNFe->dest->enderDest->nro),
                'destinatario_endereco_bairro'        => (string) trim($item->infNFe->dest->enderDest->xBairro),
                'destinatario_endereco_cod_municipio' => (string) trim($item->infNFe->dest->enderDest->cMun),
                'destinatario_endereco_municipio'     => (string) trim($item->infNFe->dest->enderDest->xMun),
                'destinatario_endereco_uf'            => (string) trim($item->infNFe->dest->enderDest->UF),
                'destinatario_endereco_cep'           => (string) trim($item->infNFe->dest->enderDest->CEP),
                'destinatario_endereco_cod_pais'      => (string) trim($item->infNFe->dest->enderDest->cPais),
                'destinatario_endereco_pais'          => (string) trim($item->infNFe->dest->enderDest->xPais),
                'destinatario_fone'                   => (string) trim($item->infNFe->dest->enderDest->fone),
                'destinatario_email'                  => (string) trim($item->infNFe->dest->email),
                'fatura_numero'                       => (string) trim($item->infNFe->cobr->fat->nFat),
                'fatura_valor'                        => (string) trim($item->infNFe->cobr->fat->vOrig),
                'fatura_desconto'                     => (string) trim($item->infNFe->cobr->fat->vDesc),
                'fatura_valor_liquido'                => (string) trim($item->infNFe->cobr->fat->vLiq)
            );
             //Define duplicatas
             foreach($item->infNFe->cobr->dup as $duplicata){
                if(strlen((string)$duplicata->nDup) <= 3){
                    $numeroDuplicata = (string) ltrim(trim($item->infNFe->ide->nNF),0).'/'.ltrim((string)$duplicata->nDup,0);
                } else {
                    $numeroDuplicata = ltrim((string)$duplicata->nDup,0);
                }
                $duplicatas[] = [
                    'duplicata_numero'     => (string) $numeroDuplicata,
                    'duplicata_vencimento' => (string) $duplicata->dVenc,
                    'duplicata_valor'      => (string) $duplicata->vDup
                ];
            }
            /*
            //Possível solução para quando não for informado duplicatas
            if(sizeof($duplicatas) == 0){
                if(isset($item->infNFe->cobr->fat->vLiq)){
                    $valorDuplicata = (string) $item->infNFe->cobr->fat->vLiq;
                } else {
                    $valorDuplicata = (string) trim($item->infNFe->total->ICMSTot->vNF);
                }
                $duplicatas[] = [
                    'duplicata_numero'     => (string) ltrim(trim($item->infNFe->ide->nNF),0).'/1',
                    'duplicata_vencimento' => (string) trim($item->infNFe->ide->dhEmi),
                    'duplicata_valor'      => (string) trim($item->infNFe->total->ICMSTot->vNF)
                ];
            }*/
            $nfe['duplicatas'] = $duplicatas;

            //Define dados de processamento
            foreach($this->xmlFile->protNFe as $key => $item){
                $nfe['chave_nfe'] = (string) trim($item->infProt->chNFe);
                $nfe['nProt']     = (string) trim($item->infProt->nProt);
                $nfe['dhRecbto']  = (string) trim($item->infProt->dhRecbto);
                $nfe['digVal']    = (string) trim($item->infProt->digVal);
                $nfe['cStat']     = (string) trim($item->infProt->cStat);
                $nfe['motivo']    = (string) trim($item->infProt->xMotivo);
                $nfe['verAplic']  = (string) trim($item->infProt->verAplic);
                $nfe['tpAmb']     = (string) trim($item->infProt->tpAmb);
            }

            //Define produtos
            foreach($this->xmlFile->NFe->infNFe->det as $key => $produto){
                $produtos[] = [
                    'produto_codigo'                 => (string) trim($produto->prod->cProd),
                    'produto_descricao'              => (string) trim($produto->prod->xProd),
                    'produto_ncm'                    => (string) trim($produto->prod->NCM),
                    'produto_CFOP'                   => (string) trim($produto->prod->CFOP),
                    'produto_uCom'                   => (string) trim($produto->prod->uCom),
                    'protudo_qCom'                   => (string) trim($produto->prod->qCom),
                    'produto_vUnCom'                 => (string) trim($produto->prod->vUnCom),
                    'produto_vProd'                  => (string) trim($produto->prod->vProd),
                    'produto_uTrib'                  => (string) trim($produto->prod->uTrib),
                    'produto_qTrib'                  => (string) trim($produto->prod->qTrib),
                    'produto_vUnTrib'                => (string) trim($produto->prod->vUnTrib),
                    'produto_indTot'                 => (string) trim($produto->prod->indTot),
                    'produto_imposto_icms_orig'      => (string) trim($produto->imposto->ICMS->ICMS00->orig),
                    'produto_imposto_icms_CST'       => (string) trim($produto->imposto->ICMS->ICMS00->CST),
                    'produto_imposto_icms_modBC'     => (string) trim($produto->imposto->ICMS->ICMS00->modBC),
                    'produto_imposto_icms_vBC'       => (string) trim($produto->imposto->ICMS->ICMS00->vBC),
                    'produto_imposto_icms_pICMS'     => (string) trim($produto->imposto->ICMS->ICMS00->pICMS),
                    'produto_imposto_icms_vICMS'     => (string) trim($produto->imposto->ICMS->ICMS00->vICMS),
                    'produto_imposto_ipi_cEnq'       => (string) trim($produto->imposto->IPI->cEnq),
                    'produto_imposto_ipi_CST'        => (string) trim($produto->imposto->IPI->IPINT->CST),
                    'produto_imposto_pis_CST'        => (string) trim($produto->imposto->PIS->PISAliq->CST),
                    'produto_imposto_pis_vBC'        => (string) trim($produto->imposto->PIS->PISAliq->vBC),
                    'produto_imposto_pis_pPIS'       => (string) trim($produto->imposto->PIS->PISAliq->pPIS),
                    'produto_imposto_pis_vPIS'       => (string) trim($produto->imposto->PIS->PISAliq->vPIS),
                    'produto_imposto_cofins_CST'     => (string) trim($produto->imposto->COFINS->COFINSAliq->CST),
                    'produto_imposto_cofins_vBC'     => (string) trim($produto->imposto->COFINS->COFINSAliq->vBC),
                    'produto_imposto_cofins_pCOFINS' => (string) trim($produto->imposto->COFINS->COFINSAliq->pCOFINS),
                    'produto_imposto_cofins_vCOFINS' => (string) trim($produto->imposto->COFINS->COFINSAliq->vCOFINS),
                ];
            }
            $nfe['produtos'] = $produtos;
        }

        if(sizeof($nfe) > 0){
            return ['success' => true, 'xmlData' => $nfe];
        } else {
            return ['success' => false, 'error' => 'Não foi possível ler os dados do arquivo XML, verifique se é um arquivo XML válido'];
        }
    }

}