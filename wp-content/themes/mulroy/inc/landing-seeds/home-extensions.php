<?php
/**
 * Starter content for the "Home Extensions" landing page.
 * Copy taken from Figma: MUL_We Design_V7 > SEO PAGE (node 13100:3632).
 *
 * Returns the rows for the Dynamic Blocks (components) field, in page order.
 * Images are left empty on purpose: add them in the admin after seeding.
 *
 * @param array $ctx Links resolved by the seeder (contact, projects, terms, people).
 */
if (!defined('ABSPATH')) {
  exit;
}

return function (array $ctx) {
  $term_link = function ($slug) use ($ctx) {
    return $ctx['terms'][$slug] ?? '';
  };

  $link = function ($url, $title = '') {
    return $url ? ['title' => $title, 'url' => $url, 'target' => ''] : null;
  };

  return [
    [
      'acf_fc_layout' => 'hero_section',
      'heading'       => 'House Extension Architects in London.',
      'hero_image'    => '',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'none',
      'left_heading'  => 'We’re Mulroy.',
      'right_heading' => '',
      'lead'          => '<p>Mulroy Architects designs residential extensions that transform not only the amount of space within a home, but the way that home works for the people living in it.</p>',
      'left_column'   => '<p>Based in London, we have extensive experience across North London, including Highgate, Crouch End, Muswell Hill, Stroud Green and Whitehall Park. We work with homeowners looking to unlock the potential of existing properties through carefully considered architectural interventions.</p>',
      'right_column'  => '<p>Our approach goes beyond simply adding square metres. We consider how people move through the house, how rooms connect, where natural light enters, the relationship between inside and outside and how the needs of a household may change over time. The result is an extension designed as part of the whole home rather than simply an addition to it.</p>',
    ],

    [
      'acf_fc_layout' => 'right_only_content_block',
      'heading'       => '',
      'desc'          => '',
      'photo'         => '',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'full',
      'left_heading'  => 'Residential Extensions Across North London',
      'right_heading' => '',
      'lead'          => '',
      'left_column'   => '<p>Our residential portfolio includes extensions and major transformations of existing homes across London, with particularly strong experience in North London. We have worked with a wide variety of existing properties and project types, from carefully considered additions to substantial extensions forming part of complete whole-house transformations. Our experience includes rear and side extensions, basement extensions, internal reconfiguration and projects within sensitive planning contexts.</p>',
      'right_column'  => '<p>Every existing property presents different opportunities and constraints. Rather than applying a standard architectural response, we begin by understanding the building, its location and how it is currently used. This allows us to develop an extension that responds to its particular context while improving circulation, natural light, connections between spaces and the relationship between the home and its external areas.</p>',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'right',
      'left_heading'  => '',
      'right_heading' => 'Philosophy & Approach: Designed to Fit & Flow',
      'lead'          => '',
      'left_column'   => '<p>At Mulroy, we design from the inside out. Our Fit & Flow approach begins by understanding how our clients live today and how their needs may change in the future. During the briefing and early design process, we map who will use the building now and in the years ahead. We consider different future scenarios, how people will move through the home and how spaces need to connect.</p>',
      'right_column'  => '<p>This means an extension becomes much more than additional floor area. It can change how the entire house works: improving circulation, creating stronger connections with the garden, bringing natural light into previously constrained spaces and allowing the property to adapt more easily as family life evolves. Our aim is to create architecture that fits the way people live and flows naturally into the future.</p>',
    ],

    [
      'acf_fc_layout'      => 'two_column_left_portrait_right_landscape_image',
      'left_side_image'    => '',
      'left_side_heading'  => '',
      'right_side_image'   => '',
      'right_side_heading' => '',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'full',
      'left_heading'  => 'Project Planning & Client Guidance',
      'right_heading' => '',
      'lead'          => '',
      'left_column'   => '<p>A successful house extension begins long before construction starts. The first stage is understanding what the client wants to achieve, how the existing property currently works and what limitations or opportunities the site presents. We develop the brief alongside our clients and assess the existing building, planning context, budget, technical requirements and long-term objectives before developing the architectural response.</p>',
      'right_column'  => '<p>This early work allows different options to be explored and important decisions to be made with better information. As the project develops, Mulroy can coordinate architectural design with interior design, project management and cost management, as well as working with structural engineers, planning specialists, contractors and other consultants where required. The objective is to provide clients with a clear route from the initial idea towards a deliverable project.</p>',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'right',
      'left_heading'  => '',
      'right_heading' => 'Featured Projects: Selected Residential Transformations',
      'lead'          => '',
      'left_column'   => '<p>Our extension projects demonstrate how very different existing homes can be transformed through architecture that responds to the people who live within them.</p>',
      'right_column'  => '',
    ],

    [
      'acf_fc_layout'      => 'landing_featured_projects',
      'source'             => 'auto',
      'number_of_projects' => 4,
      'categories'         => [],
      'projects'           => [],
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'full',
      'left_heading'  => 'An Integrated Architectural Service',
      'right_heading' => '',
      'lead'          => '<p>A successful extension involves a series of interconnected decisions. Architecture, interiors, cost, programme and construction cannot always be considered independently.</p><p>Mulroy provides an integrated range of services that allows these elements to be considered together from the early stages of a project.</p>',
      'left_column'   => '',
      'right_column'  => '',
    ],

    [
      'acf_fc_layout' => 'landing_info_table',
      'rows'          => [
        ['label' => 'Architectural Design', 'description' => 'From initial briefing and feasibility through design development and technical resolution.', 'link' => null],
        ['label' => 'Interior Design', 'description' => 'Developing architecture and interiors as part of one coherent design approach.', 'link' => null],
        ['label' => 'Project Management', 'description' => 'Helping coordinate the people, information and decisions required throughout the project.', 'link' => null],
        ['label' => 'Cost Management', 'description' => 'Considering financial objectives alongside architectural decisions to help clients make informed choices as the design develops. The exact scope can be adapted to the requirements and complexity of each individual residential project.', 'link' => null],
      ],
    ],

    [
      'acf_fc_layout' => 'right_only_content_block',
      'heading'       => '',
      'desc'          => '',
      'photo'         => '',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'right',
      'left_heading'  => '',
      'right_heading' => 'Leadership & key contacts: The people behind the project',
      'lead'          => '',
      'left_column'   => '<p>Residential architecture requires a close working relationship between architect and client. At Mulroy, projects are developed collaboratively, with senior architectural input and a team structured around the particular requirements of each commission.</p>',
      'right_column'  => '<p>The people responsible for a project remain closely involved in understanding the brief, developing the architectural response and helping clients navigate the decisions that arise as the design progresses.</p>',
    ],

    [
      'acf_fc_layout'   => 'people_section',
      'list_of_peoples' => $ctx['people'],
      'layout_style'    => 'landing',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'full',
      'left_heading'  => 'Working Together: A Collaborative Approach',
      'right_heading' => '',
      'lead'          => '',
      'left_column'   => '<p>Good residential architecture depends on clear communication and effective collaboration. We work closely with our clients to understand their priorities, ambitions and concerns before translating these into a clear architectural brief.</p><p>As the project develops, this collaboration expands to include the wider professional and construction team. Depending on the requirements of the project, this may include structural engineers, planning specialists, contractors and other technical consultants.</p>',
      'right_column'  => '<p>Our role is to help bring those different areas of expertise together so that architectural ambition, technical requirements, cost and practical delivery are considered as part of the same process.</p><p>By identifying important questions early and maintaining clear communication throughout the project, we aim to give clients greater clarity as their project progresses from initial ideas towards construction.</p>',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'right',
      'left_heading'  => '',
      'right_heading' => 'Areas of Specialism',
      'lead'          => '',
      'left_column'   => '<p>House extensions often form part of a wider transformation of an existing property. Mulroy’s residential expertise therefore extends beyond the design of additional space.</p>',
      'right_column'  => '',
    ],

    [
      'acf_fc_layout' => 'landing_info_table',
      'rows'          => [
        ['label' => 'Renovations', 'description' => 'Whole-house transformations that reconsider how an existing property works and responds to present and future needs.', 'link' => $link($term_link('renovations'))],
        ['label' => 'Basements', 'description' => 'Creating additional accommodation below ground while considering its relationship with the organisation, circulation and natural light of the wider home.', 'link' => $link($term_link('basements'))],
        ['label' => 'Interior Design', 'description' => 'Developing architecture and interiors together so that space, materials and internal elements form part of one coherent design.', 'link' => null],
        ['label' => 'Listed Buildings', 'description' => 'Working with existing buildings where heritage, planning and architectural considerations require a particularly sensitive response.', 'link' => $link($term_link('listed-buildings'))],
        ['label' => 'Sustainable Architecture', 'description' => 'Considering energy performance, adaptability and long-term use alongside architectural quality.', 'link' => $link($term_link('sustainable-architecture'))],
      ],
    ],

    [
      'acf_fc_layout' => 'right_only_content_block',
      'heading'       => '',
      'desc'          => '',
      'photo'         => '',
    ],

    [
      'acf_fc_layout' => 'landing_text_section',
      'border_style'  => 'full',
      'left_heading'  => 'Contact & Project Enquiry',
      'right_heading' => '',
      'lead'          => '<p>Planning an extension or major transformation of your home? Every successful project begins with understanding what you want your home to do differently.</p>',
      'left_column'   => '<p>You may need more space, a stronger connection with the garden, better natural light, a different relationship between rooms or a home capable of adapting as your family’s needs change.</p><p>Our first conversations are about understanding those ambitions alongside the opportunities and constraints presented by the existing property.</p>',
      'right_column'  => '<p>From there, we can begin to establish the appropriate architectural approach, the services required and the next steps towards developing the project.</p><p>If you are considering extending or significantly transforming a home in London, talk to Mulroy about what you want your property to become.</p>',
    ],

    [
      'acf_fc_layout' => 'landing_cta_links',
      'links'         => array_values(array_filter([
        ['link' => $link($ctx['contact'], 'Discuss Your Project')],
        ['link' => $link($ctx['projects'], 'View Residential Projects')],
      ], function ($row) {
        return !empty($row['link']);
      })),
    ],

    // FAQs: the Figma questions are placeholder text, so the block is added
    // with its title only. Add the real questions in the admin.
    [
      'acf_fc_layout' => 'faq_section_global',
      'faq_text'      => 'FAQs',
      'faq_card'      => [],
    ],
  ];
};
