# ANVIL — Plano de publicação e reversão — MODELO (entregável n.8) — RASCUNHO
Nada será executado sem **aprovação humana do senhor Thaynan** (protocolo geral §18; manual mestre, Etapa 7→8).

## Pré-requisitos (bloqueadores)
- [ ] Aceite formal do conteúdo (ECHO/VANGUARD), do visual (IRIS) e da auditoria (BASTION), com nome, data e versão.
- [ ] Definição de quem é o responsável legal pelo site (Política de Privacidade) e do canal oficial de contato.
- [ ] Domínio e hospedagem escolhidos e pagos **pelo responsável** (o ANVIL não contrata).
- [ ] HTTPS válido; acesso ao painel da hospedagem com conta individual e 2FA.

## Publicação (janela proposta: horário de baixo tráfego, horário de Brasília)
1. Backup do estado atual do domínio, se já existir algo nele.
2. Instalar WordPress (MySQL) em homologação na hospedagem → importar tema filho + WXR → conferir.
3. Rodar os critérios de aceite técnicos (especificação §6) na homologação; o BASTION audita.
4. Trocar `noindex` → `index`, remover a faixa de rascunho, `blog_public=1`.
5. Apontar DNS (**só com autorização**); TTL reduzido para 300s 24h antes.
6. Verificação pós-publicação: 7 páginas com 200, HTTPS, sitemap, zero requisições externas.

## Reversão (rollback)
| Gatilho | Ação | Tempo-alvo |
|---|---|---|
| Erro crítico (matriz: Bloqueador) | restaurar o DNS anterior **ou** colocar a página de manutenção | ≤ 15 min |
| Conteúdo incorreto | despublicar a página (rascunho) e corrigir | ≤ 30 min |
| Falha de atualização | restaurar o último backup (SQL + wp-content), já testado | ≤ 60 min |

## Registros
Data/hora (horário de Brasília), executor, aprovador, versão do tema, hash do backup, resultado de cada etapa.
