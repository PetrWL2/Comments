<?php

use yii\db\Migration;

/**
 * Handles adding position to table `comment`.
 */
class m160822_184711_add_position_column_to_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comment', 'path', $this->string());
        $this->dropColumn('comment', 'paternt_created_at');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comment', 'path');
        $this->addColumn('comment', 'paternt_created_at', $this->datetime());
    }
}
