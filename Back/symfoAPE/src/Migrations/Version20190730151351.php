<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190730151351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE child CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE author_id author_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE date date DATETIME NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE is_published is_published TINYINT(1) NOT NULL, CHANGE content content LONGTEXT NOT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD news_id INT DEFAULT NULL, ADD event_id INT DEFAULT NULL, ADD private_post_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE url url VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CBA70CFC8 FOREIGN KEY (private_post_id) REFERENCES private_post (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB5A459A0 ON media (news_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C71F7E88B ON media (event_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CBA70CFC8 ON media (private_post_id)');
        $this->addSql('ALTER TABLE news CHANGE user_id user_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE title title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE private_post CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE role CHANGE role role VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE title title VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE address_street address_street VARCHAR(255) DEFAULT NULL, CHANGE address_other address_other VARCHAR(255) DEFAULT NULL, CHANGE address_number address_number INT DEFAULT NULL, CHANGE address_zipcode address_zipcode VARCHAR(15) DEFAULT NULL, CHANGE newsletter_subscription newsletter_subscription TINYINT(1) DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL, CHANGE is_parent is_parent TINYINT(1) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE address_city address_city VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE child CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE event CHANGE author_id author_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE date date DATETIME DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE is_published is_published TINYINT(1) DEFAULT \'NULL\', CHANGE content content LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE slug slug VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB5A459A0');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C71F7E88B');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CBA70CFC8');
        $this->addSql('DROP INDEX IDX_6A2CA10CB5A459A0 ON media');
        $this->addSql('DROP INDEX IDX_6A2CA10C71F7E88B ON media');
        $this->addSql('DROP INDEX IDX_6A2CA10CBA70CFC8 ON media');
        $this->addSql('ALTER TABLE media DROP news_id, DROP event_id, DROP private_post_id, CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE type type VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE url url VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE news CHANGE user_id user_id INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE page CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE private_post CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE role CHANGE role role VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE tag CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE lastname lastname VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE firstname firstname VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_city address_city VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_street address_street VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_other address_other VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE address_number address_number INT DEFAULT NULL, CHANGE address_zipcode address_zipcode VARCHAR(15) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE newsletter_subscription newsletter_subscription TINYINT(1) DEFAULT \'NULL\', CHANGE is_active is_active TINYINT(1) DEFAULT \'NULL\', CHANGE is_parent is_parent TINYINT(1) DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}