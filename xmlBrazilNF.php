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
                'nf_versao'                           => (string) trim($item->infNFe->attributes()->versao),
                'nf_id'                               => (string) trim($item->infNFe->attributes()->Id),
                'nf_numero'                           => (string) trim($item->infNFe->ide->nNF),
                'nf_c_uf'                             => (string) trim($item->infNFe->ide->cUF),
                'nf_nat_op'                           => (string) trim($item->infNFe->ide->natOp),
                'nf_mod'                              => (string) trim($item->infNFe->ide->mod),
                'nf_id_dest'                          => (string) trim($item->infNFe->ide->idDest),
                'nf_c_mun_fg'                         => (string) trim($item->infNFe->ide->cMunFG),
                'nf_tp_imp'                           => (string) trim($item->infNFe->ide->tpImp),
                'nf_tp_emis'                          => (string) trim($item->infNFe->ide->tpEmis),
                'nf_c_dv'                             => (string) trim($item->infNFe->ide->cDV),
                'nf_tp_amb'                           => (string) trim($item->infNFe->ide->tpAmb),
                'nf_fin_nfe'                          => (string) trim($item->infNFe->ide->finNFe),
                'nf_ind_final'                        => (string) trim($item->infNFe->ide->indFinal),
                'nf_ind_pres'                         => (string) trim($item->infNFe->ide->indPres),
                'nf_proc_emi'                         => (string) trim($item->infNFe->ide->procEmi),
                'nf_ver_proc'                         => (string) trim($item->infNFe->ide->verProc),
                'nf_cnf'                              => (string) trim($item->infNFe->ide->cNF),
                'nf_tipo'                             => (string) trim($item->infNFe->ide->tpNF),
                'nf_serie'                            => (string) trim($item->infNFe->ide->serie),
                'nf_data_emissao'                     => (string) trim($item->infNFe->ide->dhEmi),
                'nf_inf_adic_fisco'                   => (string) trim($item->infNFe->infAdic->infAdFisco),
                'nf_inf_adic_cpl'                     => (string) trim($item->infNFe->infAdic->infCpl),
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
                'transporte_mod_frete'                => (string) trim($item->infNFe->transp->modFrete),
                'transporte_transportadora_nome'      => (string) trim($item->infNFe->transp->transporta->xNome),
                'fatura_numero'                       => (string) trim($item->infNFe->cobr->fat->nFat),
                'fatura_valor'                        => (float) $item->infNFe->cobr->fat->vOrig,
                'fatura_desconto'                     => (float) $item->infNFe->cobr->fat->vDesc,
                'fatura_valor_liquido'                => (float) $item->infNFe->cobr->fat->vLiq,
                'total_v_bc'                          => (float) $item->infNFe->total->ICMSTot->vBC,
                'total_v_icms'                        => (float) $item->infNFe->total->ICMSTot->vICMS,
                'total_v_icms_deson'                  => (float) $item->infNFe->total->ICMSTot->vICMSDeson,
                'total_v_fcp'                         => (float) $item->infNFe->total->ICMSTot->vFCP,
                'total_v_bcst'                        => (float) $item->infNFe->total->ICMSTot->vBCST,
                'total_v_st'                          => (float) $item->infNFe->total->ICMSTot->vST,
                'total_v_fcpst'                       => (float) $item->infNFe->total->ICMSTot->vFCPST,
                'total_v_fcpst_ret'                   => (float) $item->infNFe->total->ICMSTot->vFCPSTRet,
                'total_v_prod'                        => (float) $item->infNFe->total->ICMSTot->vProd,
                'total_v_frete'                       => (float) $item->infNFe->total->ICMSTot->vFrete,
                'total_v_seg'                         => (float) $item->infNFe->total->ICMSTot->vSeg,
                'total_v_desc'                        => (float) $item->infNFe->total->ICMSTot->vDesc,
                'total_v_ii'                          => (float) $item->infNFe->total->ICMSTot->vII,
                'total_v_ipi'                         => (float) $item->infNFe->total->ICMSTot->vIPI,
                'total_v_ipi_devol'                   => (float) $item->infNFe->total->ICMSTot->vIPIDevol,
                'total_v_pis'                         => (float) $item->infNFe->total->ICMSTot->vPIS,
                'total_v_cofins'                      => (float) $item->infNFe->total->ICMSTot->vCOFINS,
                'total_v_outro'                       => (float) $item->infNFe->total->ICMSTot->vOutro,
                'total_v_nf'                          => (float) $item->infNFe->total->ICMSTot->vNF,
                'pag_ind_pag'                         => (string) trim($item->infNFe->pag->detPag->indPag),
                'pag_t_pag'                           => (string) trim($item->infNFe->pag->detPag->tPag),
                'pag_v_pag'                           => (float) $item->infNFe->pag->detPag->vPag,
                'signature_digest_value'              => (string) trim($item->Signature->SignedInfo->Reference->DigestValue),
                'signature_value'                     => (string) trim($item->Signature->SignatureValue),
                'signature_x509_certificate'          => (string) trim($item->Signature->KeyInfo->X509Data->X509Certificate),
            );

            //Define dados de processamento
            foreach($this->xmlFile->protNFe as $key => $itemProt){
                $nfe['prot_chave_nfe']  = (string) trim($itemProt->infProt->chNFe);
                $nfe['prot_n_prot']     = (string) trim($itemProt->infProt->nProt);
                $nfe['prot_dh_recbto']  = (string) trim($itemProt->infProt->dhRecbto);
                $nfe['prot_dig_val']    = (string) trim($itemProt->infProt->digVal);
                $nfe['prot_c_stat']     = (string) trim($itemProt->infProt->cStat);
                $nfe['prot_motivo']     = (string) trim($itemProt->infProt->xMotivo);
                $nfe['prot_ver_aplic']  = (string) trim($itemProt->infProt->verAplic);
                $nfe['prot_tp_amb']     = (string) trim($itemProt->infProt->tpAmb);
            }

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
                    'duplicata_valor'      => (float) $duplicata->vDup
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

            //Define produtos
            foreach($item->infNFe->det as $produto){
                $produtos[] = [
                    'produto_numero_item'             => (string) trim($produto->attributes()->nItem),
                    'produto_codigo'                  => (string) trim($produto->prod->cProd),
                    'produto_descricao'               => (string) trim($produto->prod->xProd),
                    'produto_ncm'                     => (string) trim($produto->prod->NCM),
                    'produto_cfop'                    => (string) trim($produto->prod->CFOP),
                    'produto_u_com'                   => (string) trim($produto->prod->uCom),
                    'protudo_q_com'                   => (float) $produto->prod->qCom,
                    'produto_v_un_com'                => (float) $produto->prod->vUnCom,
                    'produto_v_prod'                  => (float) $produto->prod->vProd,
                    'produto_u_trib'                  => (string) trim($produto->prod->uTrib),
                    'produto_q_trib'                  => (float) $produto->prod->qTrib,
                    'produto_v_un_trib'               => (float) $produto->prod->vUnTrib,
                    'produto_ind_tot'                 => (string) trim($produto->prod->indTot),
                    'produto_imposto_icms_orig'       => (string) trim($produto->imposto->ICMS->ICMS00->orig),
                    'produto_imposto_icms_cst'        => (string) trim($produto->imposto->ICMS->ICMS00->CST),
                    'produto_imposto_icms_mod_bc'     => (string) trim($produto->imposto->ICMS->ICMS00->modBC),
                    'produto_imposto_icms_v_bc'       => (float) $produto->imposto->ICMS->ICMS00->vBC,
                    'produto_imposto_icms_p_icms'     => (float) $produto->imposto->ICMS->ICMS00->pICMS,
                    'produto_imposto_icms_v_icms'     => (float) $produto->imposto->ICMS->ICMS00->vICMS,
                    'produto_imposto_ipi_c_enq'       => (string) trim($produto->imposto->IPI->cEnq),
                    'produto_imposto_ipi_cst'         => (string) trim($produto->imposto->IPI->IPINT->CST),
                    'produto_imposto_pis_cst'         => (string) trim($produto->imposto->PIS->PISAliq->CST),
                    'produto_imposto_pis_v_bc'        => (float) $produto->imposto->PIS->PISAliq->vBC,
                    'produto_imposto_pis_p_pis'       => (float) $produto->imposto->PIS->PISAliq->pPIS,
                    'produto_imposto_pis_v_pis'       => (float) $produto->imposto->PIS->PISAliq->vPIS,
                    'produto_imposto_cofins_cst'      => (string) trim($produto->imposto->COFINS->COFINSAliq->CST),
                    'produto_imposto_cofins_v_bc'     => (float) $produto->imposto->COFINS->COFINSAliq->vBC,
                    'produto_imposto_cofins_p_cofins' => (float) $produto->imposto->COFINS->COFINSAliq->pCOFINS,
                    'produto_imposto_cofins_v_cofins' => (float) $produto->imposto->COFINS->COFINSAliq->vCOFINS,
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