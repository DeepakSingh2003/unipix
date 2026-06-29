<?php
/*** Child Theme Function ***/

/* Load parent + child CSS properly */
function unipix_enqueue_child_theme_styles() {

    wp_enqueue_style(
        'unipix-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'unipix-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('unipix-style'),
        time()
    );
}
add_action('wp_enqueue_scripts', 'unipix_enqueue_child_theme_styles', 999);


/* Vedic Mind Training Shortcode */
function chinmaya_vedic_training_section() {
    ob_start();
    ?>

    <section class="cv-vedic-section">
        <div class="cv-vedic-left">
            <div class="cv-top-line"></div>

            <h2>The Art of Vedic Mind Training</h2>

            <p>
                We integrate Vedic wisdom with the CBSE curriculum through yoga, Ayurveda,
                character building, and Vedic practices that nurture the mind, body, and spirit.
            </p>

            <div class="cv-tab-list">
                <button type="button" class="active"
                    data-title="Yoga and Meditation"
                    data-img="http://unipix.test/wp-content/uploads/2026/06/KB131960-scaled.jpg"
                    data-text="Yoga and meditation help students develop physical fitness, mental clarity, emotional balance, and inner peace from a young age.">
                    Yoga &amp; Meditation
                </button>

                <button type="button"
                    data-title="Ayurvedic Wisdom"
                    data-img="http://unipix.test/wp-content/uploads/2026/06/KB132047-scaled.jpg"
                    data-text="Ayurveda introduces students to natural wellness, healthy living, and preventive care rooted in ancient Indian knowledge.">
                    Ayurvedic Wisdom
                </button>

                <button type="button"
                    data-title="Character Building"
                    data-img="http://unipix.test/wp-content/uploads/2026/06/KB131731-scaled.jpg"
                    data-text="Value-based education nurtures discipline, leadership, confidence, responsibility, and strong moral character.">
                    Character Building
                </button>

                <button type="button"
                    data-title="Vedic Yagyas"
                    data-img="http://unipix.test/wp-content/uploads/2026/06/KB132047-scaled.jpg"
                    data-text="Traditional Vedic Yagyas promote mindfulness, positivity, environmental awareness, and spiritual growth among students.">
                    Vedic Yagyas
                </button>
            </div>
        </div>

        <div class="cv-vedic-right">
            <img id="cv-vedic-img" src="http://unipix.test/wp-content/uploads/2026/06/KB131960-scaled.jpg" alt="Yoga and Meditation">

            <div class="cv-vedic-content">
                <h3 id="cv-vedic-title">Yoga and Meditation</h3>
                <p id="cv-vedic-text">
                    Yoga and meditation help students develop physical fitness, mental clarity,
                    emotional balance, and inner peace from a young age.
                </p>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".cv-tab-list button");
        const title = document.getElementById("cv-vedic-title");
        const text = document.getElementById("cv-vedic-text");
        const img = document.getElementById("cv-vedic-img");

        buttons.forEach(function(btn) {
            btn.addEventListener("click", function() {
                buttons.forEach(function(b) {
                    b.classList.remove("active");
                });

                this.classList.add("active");

                title.innerText = this.dataset.title;
                text.innerText = this.dataset.text;
                img.src = this.dataset.img;
                img.alt = this.dataset.title;
            });
        });
    });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('chinmaya_vedic_tabs', 'chinmaya_vedic_training_section');
function chinmaya_happy_faces_section() {
ob_start(); ?>

<section class="cv-happy-faces">

    <div class="cv-happy-left">

        <span class="cv-small-line"></span>

        <h2>
            HAPPY FACES <br>
            <span>AT CHINMAYA</span>
        </h2>

        <p>
            There is never a dull day at Chinmaya. The school lights up with the smile
            of these little angels and teaches us, elders, how to embrace life.
            We only do our bit to create an environment to keep them going in
            their pursuits of happy lives.
        </p>

        <div class="cv-img-large">
            <img src="http://unipix.test/wp-content/uploads/2026/06/KB131236-scaled.jpg" alt="">
        </div>

    </div>

    <div class="cv-happy-right">

        <div class="cv-img-top">
            <img src="http://unipix.test/wp-content/uploads/2026/06/KB131259-scaled.jpg" alt="">
        </div>

        <div class="cv-img-bottom">
            <img src="http://unipix.test/wp-content/uploads/2026/06/KB131278-scaled.jpg" alt="">
        </div>

    </div>

</section>

<?php
return ob_get_clean();
}
add_shortcode('chinmaya_happy_faces', 'chinmaya_happy_faces_section');
function infrastructure_cards_shortcode() {
ob_start();
?>

<div class="infra-cards">

  <div class="infra-card" style="background-image:url('http://unipix.test/wp-content/uploads/2026/06/KB131737-scaled.jpg');">
    <div class="infra-title">Class-rooms</div>
    <div class="infra-overlay">
      <h3>Class-rooms</h3>
      <p>We have around 20-25 students in each class and we maintain a very healthy teacher-student ratio of 1:10. All the classes are supported by Educomp Smart Class, following concept based and application oriented teaching methodology.</p>
      <a href="#" class="infra-btn">Read More</a>
    </div>
  </div>

  <div class="infra-card" style="background-image:url('http://unipix.test/wp-content/uploads/2026/06/KB131389-scaled.jpg');">
    <div class="infra-title">Laboratories</div>
    <div class="infra-overlay">
      <h3>Laboratories</h3>
      <p>The school has well equipped Physics, Chemistry, Biology, Mathematics and Geography Laboratories with latest state of art equipment and materials. The students are encouraged towards practical experience to understand the basics of science.</p>
      <a href="#" class="infra-btn">Read More</a>
    </div>
  </div>

  <div class="infra-card" style="background-image:url('http://unipix.test/wp-content/uploads/2026/06/KB131440-scaled.jpg');">
    <div class="infra-title">Computer Lab</div>
    <div class="infra-overlay">
      <h3>Computer Lab</h3>
      <p>In the present world, it is very difficult to live without practical computer knowledge. The School emphasizes on computer education from grades I to X. In grades XI and XII, Informatics Practices is an optional subject.</p>
      <a href="#" class="infra-btn">Read More</a>
    </div>
  </div>

  <div class="infra-card" style="background-image:url('http://unipix.test/wp-content/uploads/2026/06/KB131537-scaled.jpg');">
    <div class="infra-title">Library</div>
    <div class="infra-overlay">
      <h3>Library</h3>
      <p>“Books are a man’s best friend.” The School has a well stocked Library with more than 8000 books and every year the school adds more books. The Library is designed to meet the future needs of the changing pattern of education.</p>
      <a href="#" class="infra-btn">Read More</a>
    </div>
  </div>

</div>

<?php
return ob_get_clean();
}
add_shortcode('infrastructure_cards', 'infrastructure_cards_shortcode');
function chinmaya_co_curricular_modern() {
ob_start(); ?>

<section class="cc-modern-section">
  <div class="cc-left">
    <span>BEYOND ACADEMICS</span>
    <h2>CO-CURRICULAR<br>AT <b>CHINMAYA</b></h2>
    <p>
      Apart from academics the school lays high emphasis on overall development of the students.
      The school has ample space, huge grounds and infrastructure for both indoor and outdoor sports.
      School participates in various inter-school and inter-state competitions and tournaments.
    </p>
    <a href="#" class="cc-read-btn">READ MORE <em>→</em></a>
  </div>

  <div class="cc-card-grid">

    <div class="cc-card cc-card-wide">
      <img src="http://unipix.test/wp-content/uploads/2026/06/KB131890-scaled.jpg" alt="">
      <div class="cc-card-body">
        <div class="cc-icon">🥋</div>
        <h3>MARTIAL ARTS</h3>
        <p>Developing focus, discipline and confidence through the practice of martial arts.</p>
      </div>
    </div>

    <div class="cc-card cc-card-wide">
      <img src="http://unipix.test/wp-content/uploads/2026/06/KB132439-scaled.jpg" alt="">
      <div class="cc-card-body">
        <div class="cc-icon">🏀</div>
        <h3>BASKETBALL</h3>
        <p>Encouraging teamwork, agility and sportsmanship on and off the court.</p>
      </div>
    </div>

    <div class="cc-card">
      <img src="http://unipix.test/wp-content/uploads/2026/06/KB131284-scaled.jpg" alt="">
      <div class="cc-card-body">
        <div class="cc-icon">🎭</div>
        <h3>ARTS & CULTURE</h3>
        <p>Nurturing creativity, expression and appreciation for the arts and culture.</p>
      </div>
    </div>

    <div class="cc-card">
      <img src="http://unipix.test/wp-content/uploads/2026/06/KB132418-scaled.jpg" alt="">
      <div class="cc-card-body">
        <div class="cc-icon">🏐</div>
        <h3>VOLLEYBALL</h3>
        <p>Building strength, coordination and the spirit of healthy competition.</p>
      </div>
    </div>

    <div class="cc-card">
      <img src="http://unipix.test/wp-content/uploads/2026/06/KB131581-scaled.jpg" alt="">
      <div class="cc-card-body">
        <div class="cc-icon">♫</div>
        <h3>MUSIC & DANCE</h3>
        <p>Inspiring rhythm, creativity and self-expression through music and dance.</p>
      </div>
    </div>

  </div>
</section>

<?php return ob_get_clean();
}
add_shortcode('chinmaya_co_curricular_modern', 'chinmaya_co_curricular_modern');
function chinmaya_alumni_slider_shortcode() {
ob_start(); ?>

<section class="cv-alumni-sec">
  <div class="cv-alumni-head">
    <span>OUR PRIDE</span>
    <h2>OUR DISTINGUISHED ALUMNI</h2>
    <p>Our alumni are our pride. They continue to inspire with their achievements and contributions across diverse fields and walks of life.</p>
  </div>

  <div class="cv-slider-wrap">
    <button type="button" class="cv-nav cv-prev">‹</button>

    <div class="cv-side-card cv-side-left">
      <img id="cv-prev-img" src="IMAGE2_URL" alt="">
    </div>

    <div class="cv-main-card">
      <div class="cv-main-img">
        <img id="cv-main-img" src="IMAGE1_URL" alt="">
        <div class="cv-img-shape"></div>
        <div class="cv-quote">“</div>
      </div>

      <div class="cv-main-content">
        <h3 id="cv-name">Ambika Kamal</h3>
        <h4 id="cv-role">Mumbai-Based Theatre Actor and Director (2009 Batch)</h4>
        <span class="cv-line"></span>
        <p id="cv-desc">
          Ambika graduated from the Department of Indian Theatre, Punjab University, Chandigarh. She has been performing and directing devised plays. Her journey reflects creativity, discipline, and dedication.
        </p>
        <a href="#" class="cv-btn">VIEW DETAILS <span>›</span></a>
      </div>
    </div>

    <div class="cv-side-card cv-side-right">
      <img id="cv-next-img" src="IMAGE3_URL" alt="">
    </div>

    <button type="button" class="cv-nav cv-next">›</button>
  </div>

  <div class="cv-dots"></div>

  <div class="cv-alumni-cta">
    <div class="cv-cta-icon">🎓</div>
    <div>
      <h3>Are you our Alumni?</h3>
      <p>We would love to hear from you and feature your journey.</p>
    </div>
    <a href="#">CONNECT WITH US <span>›</span></a>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function(){
  const alumni = [
    {
      img:"http://unipix.test/wp-content/uploads/2026/06/93dcb81e-03ec-4a77-a8d2-4fe23e02b118-min.jpg",
      name:"Ambika Kamal",
      role:"Mumbai-Based Theatre Actor and Director (2009 Batch)",
      desc:"Ambika graduated from the Department of Indian Theatre, Punjab University, Chandigarh. She has been performing and directing devised plays. Her journey reflects creativity, discipline, and dedication."
    },
    {
      img:"http://unipix.test/wp-content/uploads/2024/08/Sidharath-Joshi-1536x1023-1-768x512-1.jpg",
      name:"Sidharath Joshi",
      role:"Industrial and Manufacturing Engineering, AIT Thailand (2013 Batch)",
      desc:"Sidharath’s journey reflects academic excellence, determination, and hard work. His achievements continue to inspire students to dream big and pursue excellence."
    },
    {
      img:"http://unipix.test/wp-content/uploads/2026/06/Bharat-Joshi-min.jpg",
      name:"Dr. Bharat Joshi",
      role:"BDS, MDS, MISP",
      desc:"Dr. Bharat Joshi credits Chinmaya for building discipline, confidence, and values that helped shape his successful professional journey."
    }
  ];

  let index = 0;

  const mainImg = document.getElementById("cv-main-img");
  const prevImg = document.getElementById("cv-prev-img");
  const nextImg = document.getElementById("cv-next-img");
  const name = document.getElementById("cv-name");
  const role = document.getElementById("cv-role");
  const desc = document.getElementById("cv-desc");
  const dotsWrap = document.querySelector(".cv-dots");

  if(!mainImg || !prevImg || !nextImg || !dotsWrap) return;

  alumni.forEach((_, i) => {
    const dot = document.createElement("span");
    if(i === 0) dot.classList.add("active");
    dot.addEventListener("click", () => {
      index = i;
      updateSlider();
    });
    dotsWrap.appendChild(dot);
  });

  function updateSlider(){
    const prev = (index - 1 + alumni.length) % alumni.length;
    const next = (index + 1) % alumni.length;

    mainImg.src = alumni[index].img;
    prevImg.src = alumni[prev].img;
    nextImg.src = alumni[next].img;

    name.innerText = alumni[index].name;
    role.innerText = alumni[index].role;
    desc.innerText = alumni[index].desc;

    document.querySelectorAll(".cv-dots span").forEach((d,i)=>{
      d.classList.toggle("active", i === index);
    });
  }

  document.querySelector(".cv-next").addEventListener("click", function(){
    index = (index + 1) % alumni.length;
    updateSlider();
  });

  document.querySelector(".cv-prev").addEventListener("click", function(){
    index = (index - 1 + alumni.length) % alumni.length;
    updateSlider();
  });
});
</script>

<?php return ob_get_clean();
}
add_shortcode('chinmaya_alumni_slider', 'chinmaya_alumni_slider_shortcode');
function cv_complete_blog_page_shortcode($atts) {
    $atts = shortcode_atts(array(
        'posts' => 6,
    ), $atts);

    $current_cat = isset($_GET['blog_cat']) ? sanitize_text_field($_GET['blog_cat']) : 'all';
    $current_url = get_permalink();

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => intval($atts['posts']),
        'post_status'    => 'publish',
    );

    if (!empty($current_cat) && $current_cat !== 'all') {
        $args['category_name'] = $current_cat;
    }

    $query = new WP_Query($args);

    $categories = get_categories(array(
        'hide_empty' => true,
    ));

    ob_start(); ?>

    <section class="cv-blog-page">

        <div class="cv-blog-title">
            <span>OUR BLOGS</span>
            <h2>Insights. Stories. Inspiration.</h2>
            <p>Explore our latest articles on education, boarding life, and student development.</p>
        </div>

        <div class="cv-blog-tabs">

            <a class="<?php echo ($current_cat === 'all' || empty($current_cat)) ? 'active' : ''; ?>"
               href="<?php echo esc_url(add_query_arg('blog_cat', 'all', $current_url)); ?>">
                All Posts
            </a>

            <?php foreach ($categories as $cat) : ?>
                <a class="<?php echo ($current_cat === $cat->slug) ? 'active' : ''; ?>"
                   href="<?php echo esc_url(add_query_arg('blog_cat', $cat->slug, $current_url)); ?>">
                    <?php echo esc_html($cat->name); ?>
                </a>
            <?php endforeach; ?>

        </div>

        <div class="cv-blog-grid">

            <?php if ($query->have_posts()) : ?>

                <?php while ($query->have_posts()) : $query->the_post();

                    $img = get_the_post_thumbnail_url(get_the_ID(), 'large');

                    if (!$img) {
                        $img = 'https://via.placeholder.com/900x600/071452/ffffff?text=Chinmaya+Vidyalaya';
                    }

                    $cats = get_the_category();
                    $cat_name = !empty($cats) ? $cats[0]->name : 'Blog';
                ?>

                    <article class="cv-blog-card">

                        <div class="cv-blog-image">
                            <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">

                            <div class="cv-blog-date">
                                <strong><?php echo esc_html(get_the_date('d')); ?></strong>
                                <span><?php echo esc_html(get_the_date('M')); ?></span>
                                <small><?php echo esc_html(get_the_date('Y')); ?></small>
                            </div>
                        </div>

                        <div class="cv-blog-content">
                            <div class="cv-blog-category">
                                <?php echo esc_html($cat_name); ?>
                            </div>

                            <h3>
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>

                            <p>
                                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 22, '...')); ?>
                            </p>

                            <a class="cv-blog-read" href="<?php echo esc_url(get_permalink()); ?>">
                                Read More →
                            </a>
                        </div>

                    </article>

                <?php endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <p class="cv-no-posts">No blogs found in this category.</p>

            <?php endif; ?>

        </div>

        <div class="cv-blog-newsletter">
            <div>
                <h3>Stay Ahead with Our Updates</h3>
                <p>Subscribe to our newsletter and never miss an update.</p>
            </div>

            <form>
                <input type="email" placeholder="Enter your email address">
                <button type="button">Subscribe Now →</button>
            </form>
        </div>

    </section>

    <?php return ob_get_clean();
}
add_shortcode('cv_complete_blog_page', 'cv_complete_blog_page_shortcode');

function cv_distinguished_alumni_shortcode() {

$alumni = [
    [
        'featured' => true,
        'image' => 'http://unipix.test/wp-content/uploads/2026/06/93dcb81e-03ec-4a77-a8d2-4fe23e02b118-min.jpg',
        'icon' => '',
        'name' => 'Ambika Kamal',
        'designation' => 'Mumbai-Based Theatre Actor and Director (2009 Batch)',
        'description' => 'Ambika graduated from the Department of Indian Theatre, Panjab University, Chandigarh. She has been performing and directing devised plays.'
    ],
    [
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Sidharath-Joshi-1536x1023-1-768x512-1.jpg',
        'icon' => '',
        'name' => 'Sidharath Joshi',
        'designation' => 'D.Eng. Scholar, AIT Thailand | M.Eng. Fellow | B.Tech Gold Medalist (Mechanical Engineering) | 2013 Batch',
        'description' => 'Chinmaya Vidyalaya provided the foundation for my academic success and personal growth. The dedicated faculty, strong values, and peaceful learning environment at Nauni inspired me to pursue engineering with confidence. I remain grateful to my teachers and the entire Chinmaya family for their guidance, encouragement, and lasting impact on my journey'
    ],
    [
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Shivi-Sharma_-768x768-1.jpg',
        'icon' => '🎬',
        'name' => 'Shivi Sharma',
        'designation' => 'Assistant Professor in Shoolini University (2009 Batch)',
        'description' => 'The guidance of my teachers and the supportive environment at Chinmaya Vidyalaya helped me achieve my dreams. Opportunities in academics and extracurricular activities built my confidence, leadership skills, and created memories I will always cherish.'
    ],
    [
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2026/06/Bharat-Joshi-min.jpg',
        'icon' => '',
        'name' => 'Dr. Bharat Joshi',
        'designation' => 'BDS, MDS, MISP (2006 Batch)​',
        'description' => 'Chinmaya Vidyalaya played a vital role in my success by nurturing discipline, confidence, and determination. The inspiring teachers, balanced focus on academics and extracurricular activities, and lifelong memories make me proud to be a part of the Chinmaya family.'
    ],
	 [
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Ritesh-Kumar-Awasthi-_.jpg',
        'icon' => '',
        'name' => 'Ritesh Kumar Awasthi ',
        'designation' => 'Electro Technical Officer, Dynacom Tankers. Athens, Greece (1996 Batch)',
        'description' => 'As a proud member of the schools second batch and now serving as an ETO in the Merchant Navy, I owe my success to the strong foundation built at Chinmaya Vidyalaya. The guidance of my teachers instilled perseverance, resilience, and confidence that continue to shape my journey. I will always remain grateful to my alma mater for helping me become who I am today'
    ],
	[
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Col.-Manoj-Sharma.jpeg',
        'icon' => '',
        'name' => 'Col. Manoj Sharma ',
        'designation' => 'Presently commanding Assam Riffles, Battalion in North East (1995 Batch)',
        'description' => 'As a proud member of the first pioneer batch of Chinmaya Vidyalaya, my journey to the NDA, IMA, and service in the Indian Army was built on the strong foundation laid by my teachers. Their guidance, discipline, and unwavering support shaped my character and inspired me to achieve my goals. Chinmaya Vidyalaya will always hold a special place in my heart.'
    ],
	[
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Om-Prakash.jpg',
        'icon' => '',
        'name' => 'Om Prakash',
        'designation' => 'Deck Cadet, MTM Shipping Singapore (2016 Batch)',
        'description' => 'Chinmaya Vidyalaya shaped my confidence, leadership, and character, laying the foundation for my successful maritime career. The guidance of my teachers and the values I learned here continue to inspire me. Wherever I go, I will always remain a proud Chinmayan.'
    ],
	[
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Divyanshi-Bhardwaj_.jpg',
        'icon' => '',
        'name' => 'Divyanshi Bhardwaj',
        'designation' => 'Process Developer, Genpact India Pvt. Ltd., Gurgaon. (2009 Batch)',
        'description' => 'Having studied at Chinmaya Vidyalaya from Nursery to Grade 12, I cherish every moment of my journey. Serving as the Head Girl taught me leadership, teamwork, and confidence—values that continue to guide me today. Chinmaya provided the perfect balance of academics, sports, and life skills, shaping me into a well-rounded individual. It will always be an honor to be a part of the Chinmaya family.'
    ],
	[
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Dinesh-Thakur.jpg',
        'icon' => '',
        'name' => 'Dinesh Thakur',
        'designation' => 'Horticulture Development Officer, Dept. Of Horticulture, HP govt. (1998 Batch)',
        'description' => 'Chinmaya Vidyalaya has been the foundation of my journey and success. The guidance of my teachers, Principal, and the school shaped my values and inspired me to achieve my goals. I will always cherish my school memories and hope future generations continue to make the Chinmaya family proud.'
    ],
	[
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Dr.-Monika-Sharma.jpg',
        'icon' => '',
        'name' => 'Dr. Monika Sharma',
        'designation' => 'Associate Professor, Dayanand Medical College and Hospital Ludhiana, Punjab',
        'description' => 'As a proud member of the pioneer batch, I spent 14 wonderful years at Chinmaya Vidyalaya, where I learned discipline, leadership, and lifelong values. Serving as the Head Girl and participating in numerous activities shaped my confidence and character. I am deeply grateful to my teachers, the school authorities, and my classmate Anshul Verma for giving me the opportunity to relive and share these cherished memories. Chinmaya will always hold a special place in my heart.'
    ],
	[
        'featured' => false,
        'image' => 'http://unipix.test/wp-content/uploads/2024/08/Ashish.jpg',
        'icon' => '',
        'name' => 'Ashish',
        'designation' => 'Team leader (Package Solution Consultant SAP SCM SD), IBM. (2009 Batch)',
        'description' => 'I feel proud to be a student of Chinmaya. There are lot of great memories of mine associated with the school. What I am today is because of the blessings of my teachers who inculcated good “sanskars” in me. Chinmaya gave me a lot of opportunities to participate in various cultural and sports activities. I won various prizes at school block, district and state level, and National level too. I am a proud Chinmayan.'
    ],
];

ob_start(); ?>

<section class="cvda-section">
  <div class="cvda-head">
    <span>CELEBRATING EXCELLENCE</span>
    <h2>OUR DISTINGUISHED ALUMNI</h2>
    <p>Our alumni are our pride. They continue to inspire with their achievements and contributions across diverse fields and walks of life.</p>
  </div>

  <div class="cvda-slider-wrap">
    <button class="cvda-arrow cvda-prev" type="button">‹</button>

    <div class="cvda-slider">
      <?php foreach ($alumni as $item) : ?>
        <div class="cvda-card <?php echo !empty($item['featured']) ? 'cvda-featured' : ''; ?>">

          <?php if (!empty($item['image'])) : ?>
            <div class="cvda-img">
              <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['name']); ?>">
              <span>“</span>
            </div>
          <?php else : ?>
            <div class="cvda-icon"><?php echo esc_html($item['icon']); ?></div>
          <?php endif; ?>

          <h3><?php echo esc_html($item['name']); ?></h3>
          <h4><?php echo esc_html($item['designation']); ?></h4>
          <p><?php echo esc_html($item['description']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <button class="cvda-arrow cvda-next" type="button">›</button>
  </div>

  <div class="cvda-cta">
    <div class="cvda-cta-icon">👥</div>
    <div>
      <h3>Are you our Alumni?</h3>
      <p>We would love to hear from you and feature your journey.</p>
    </div>
    <a href="#">CONNECT WITH US →</a>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".cvda-slider");
  const next = document.querySelector(".cvda-next");
  const prev = document.querySelector(".cvda-prev");

  if (slider && next && prev) {
    next.addEventListener("click", function () {
      slider.scrollBy({ left: 330, behavior: "smooth" });
    });

    prev.addEventListener("click", function () {
      slider.scrollBy({ left: -330, behavior: "smooth" });
    });
  }
});
</script>

<?php
return ob_get_clean();
}
add_shortcode('cv_distinguished_alumni', 'cv_distinguished_alumni_shortcode');