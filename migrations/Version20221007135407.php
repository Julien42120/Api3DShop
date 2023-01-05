<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007135407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE printing_material (printing_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_CCCFE7767C9783D2 (printing_id), INDEX IDX_CCCFE776E308AC6F (material_id), PRIMARY KEY(printing_id, material_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE printing_material ADD CONSTRAINT FK_CCCFE7767C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE printing_material ADD CONSTRAINT FK_CCCFE776E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_printing DROP INDEX IDX_AE1022987C9783D2, ADD UNIQUE INDEX UNIQ_AE1022987C9783D2 (printing_id)');
        $this->addSql('ALTER TABLE cart_printing DROP INDEX IDX_AE102298E308AC6F, ADD UNIQUE INDEX UNIQ_AE102298E308AC6F (material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing_material DROP FOREIGN KEY FK_CCCFE7767C9783D2');
        $this->addSql('ALTER TABLE printing_material DROP FOREIGN KEY FK_CCCFE776E308AC6F');
        $this->addSql('DROP TABLE printing_material');
        $this->addSql('ALTER TABLE cart_printing DROP INDEX UNIQ_AE1022987C9783D2, ADD INDEX IDX_AE1022987C9783D2 (printing_id)');
        $this->addSql('ALTER TABLE cart_printing DROP INDEX UNIQ_AE102298E308AC6F, ADD INDEX IDX_AE102298E308AC6F (material_id)');
    }
}
