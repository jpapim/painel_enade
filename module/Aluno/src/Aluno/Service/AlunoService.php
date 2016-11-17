<?php

namespace Aluno\Service;

use \Aluno\Entity\AlunoEntity as Entity;

class AlunoService extends Entity
{

    /**
     *
     * @var type
     */
    protected $configList;

    /**
     * @param type $configList
     */
    public function setConfigList($configList)    {
        $this->configList = $configList;
    }

    public function getAlunoToArray($id)
    {
        $sql = new Sql($this->getAdapter());

        $select = $sql->select('aluno')
            ->where([
                'aluno.id_aluno= ?' => $id,
            ]);
        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function buscarAluno($params)
    {
        $resultSet = null;
        if (isset($params['id_aluno']) && $params['id_aluno']) {
            $resultSet = $this->select(['aluno.id_aluno = ?'
            => $params['id_aluno']]);
        }
        return $resultSet;
    }

    public function getFilterAlunoPorNome($nm_aluno)
    {
        $sql = new Sql($this->getAdapter());

        $select = $sql->select('tcc')
            ->columns(array('nm_aluno'))
            ->where(['aluno.nm_aluno LIKE ?' => '%' . $nm_aluno . '%']);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getPaginatorAluno($filter = NULL, $camposFilter = NULL)
    {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('aluno')->columns([
            'id_aluno',
            'id_curso',
            'id_sexo',
            'nm_aluno',
            'nr_matricula',
            'em_email',

        ]);

        $where = [
        ];

        if (!empty($filter)) {

            foreach ($filter as $key => $value) {

                if ($value) {

                    if (isset($camposFilter[$key]['mascara'])) {

                        eval("\$value = " . $camposFilter[$key]['mascara'] . ";");
                    }

                    $where[$camposFilter[$key]['filter']] = '%' . $value . '%';
                }
            }
        }

        $select->where($where);
        //$select->order(['<campo> ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    

}