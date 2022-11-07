<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005080714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing DROP FOREIGN KEY FK_308F6DF3E308AC6F');
        $this->addSql('DROP INDEX IDX_308F6DF3E308AC6F ON printing');
        $this->addSql('ALTER TABLE printing DROP material_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing ADD material_id INT NOT NULL');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF3E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('CREATE INDEX IDX_308F6DF3E308AC6F ON printing (material_id)');
    }
}
