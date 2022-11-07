<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007135104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_printing DROP INDEX UNIQ_AE102298E308AC6F, ADD INDEX IDX_AE102298E308AC6F (material_id)');
        $this->addSql('ALTER TABLE cart_printing DROP INDEX UNIQ_AE1022987C9783D2, ADD INDEX IDX_AE1022987C9783D2 (printing_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_printing DROP INDEX IDX_AE1022987C9783D2, ADD UNIQUE INDEX UNIQ_AE1022987C9783D2 (printing_id)');
        $this->addSql('ALTER TABLE cart_printing DROP INDEX IDX_AE102298E308AC6F, ADD UNIQUE INDEX UNIQ_AE102298E308AC6F (material_id)');
    }
}
