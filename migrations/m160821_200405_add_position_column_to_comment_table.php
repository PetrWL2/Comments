<?php

use yii\db\Migration;

/**
 * Handles adding position to table `comment`.
 */
class m160821_200405_add_position_column_to_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comment', 'article_id', $this->integer());
        $this->addColumn('comment', 'text', $this->text());
        $this->addColumn('comment', 'name', $this->string());
        $this->addColumn('comment', 'email', $this->string());
        $this->addColumn('comment', 'created_at', $this->datetime());
        $this->addColumn('comment', 'paternt_created_at', $this->datetime());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comment', 'article_id');
        $this->dropColumn('comment', 'text');
        $this->dropColumn('comment', 'name');
        $this->dropColumn('comment', 'email');
        $this->dropColumn('comment', 'created_at');
        $this->dropColumn('comment', 'paternt_created_at');
    }
}
