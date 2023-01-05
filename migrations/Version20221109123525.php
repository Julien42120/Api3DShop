<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109123525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing ADD default_material_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF337FBBFD9 FOREIGN KEY (default_material_id) REFERENCES material (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_308F6DF337FBBFD9 ON printing (default_material_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing DROP FOREIGN KEY FK_308F6DF337FBBFD9');
        $this->addSql('DROP INDEX UNIQ_308F6DF337FBBFD9 ON printing');
        $this->addSql('ALTER TABLE printing DROP default_material_id');
    }
}
