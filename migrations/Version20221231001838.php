<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221231001838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SEQUENCE pricing_plan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE pricing_plan_benefit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE pricing_plan_feature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pricing_plan (id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pricing_plan_pricing_plan_feature (pricing_plan_id INT NOT NULL, pricing_plan_feature_id INT NOT NULL, INDEX IDX_D19087D429628C71 (pricing_plan_id), INDEX IDX_D19087D46C9002D8 (pricing_plan_feature_id), PRIMARY KEY(pricing_plan_id, pricing_plan_feature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pricing_plan_benefit (id INT NOT NULL, pricing_plan_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E6A62C5F29628C71 (pricing_plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pricing_plan_feature (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature ADD CONSTRAINT FK_D19087D429628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature ADD CONSTRAINT FK_D19087D46C9002D8 FOREIGN KEY (pricing_plan_feature_id) REFERENCES pricing_plan_feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pricing_plan_benefit ADD CONSTRAINT FK_E6A62C5F29628C71 FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plan (id)');

        $this->addSql("INSERT INTO pricing_plan VALUES(1,'FREE', 0)");
        $this->addSql("INSERT INTO pricing_plan VALUES(2, 'PRO', 15)");
        $this->addSql("INSERT INTO pricing_plan VALUES(3, 'Enterprise', 30)");

        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(1, 1, '10 users included')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(2, 1, '2 GB of storage')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(3, 1, 'Email support')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(4, 1, 'Help center access')");
        
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(5, 2, '20 users included')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(6, 2, '10 GB of storage')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(7, 2, 'Priority email support')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(8, 2, 'Help center access')");

        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(9, 3, '20 users included')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(10, 3, '10 GB of storage')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(11, 3, 'Phone and email support')");
        $this->addSql("INSERT INTO pricing_plan_benefit VALUES(12, 3, 'Help center access')");

        $this->addSql("INSERT INTO pricing_plan_feature VALUES(1, 'Public')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(2, 'Private')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(3, 'Permissions')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(4, 'Sharing')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(5, 'Unlimited menbers')");
        $this->addSql("INSERT INTO pricing_plan_feature VALUES(6, 'Extra security')");

        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(1, 1)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(1, 2)");

        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 1)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 2)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 3)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 4)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(2, 5)");

        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 1)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 2)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 3)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 4)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 5)");
        $this->addSql("INSERT INTO pricing_plan_pricing_plan_feature VALUES(3, 6)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature DROP FOREIGN KEY FK_D19087D429628C71');
        $this->addSql('ALTER TABLE pricing_plan_pricing_plan_feature DROP FOREIGN KEY FK_D19087D46C9002D8');
        $this->addSql('ALTER TABLE pricing_plan_benefit DROP FOREIGN KEY FK_E6A62C5F29628C71');
        $this->addSql('DROP TABLE pricing_plan');
        $this->addSql('DROP TABLE pricing_plan_pricing_plan_feature');
        $this->addSql('DROP TABLE pricing_plan_benefit');
        $this->addSql('DROP TABLE pricing_plan_feature');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
