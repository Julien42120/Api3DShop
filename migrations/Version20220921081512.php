<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921081512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, billing_address VARCHAR(255) NOT NULL, delivery_address VARCHAR(255) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE printing ADD order_printing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF36725FC54 FOREIGN KEY (order_printing_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_308F6DF36725FC54 ON printing (order_printing_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing DROP FOREIGN KEY FK_308F6DF36725FC54');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP INDEX IDX_308F6DF36725FC54 ON printing');
        $this->addSql('ALTER TABLE printing DROP order_printing_id');
    }
}
