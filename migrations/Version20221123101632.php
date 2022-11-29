<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123101632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF31AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_308F6DF31AD5CDBF ON printing (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing DROP FOREIGN KEY FK_308F6DF31AD5CDBF');
        $this->addSql('DROP INDEX IDX_308F6DF31AD5CDBF ON printing');
        $this->addSql('ALTER TABLE printing DROP cart_id');
    }
}