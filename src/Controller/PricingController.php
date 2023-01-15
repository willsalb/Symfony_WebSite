<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PricingPlan;
use App\Entity\PricingPlanFeature;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\PricingPlanRepository;
use App\Repository\PricingPlanFeatureRepository;

class PricingController extends AbstractController
{
    #[Route('/pricing', name: 'pricing')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $princingPlans = $doctrine->getRepository(PricingPlan::class)->findAll();
        $princingPlansFeatures = $doctrine->getRepository(PricingPlanFeature::class)->findAll();

        return $this->render('pricing/index.html.twig', [
            'pricing_plans' => $princingPlans,
            'features' => $princingPlansFeatures
        ]);
    }
}
