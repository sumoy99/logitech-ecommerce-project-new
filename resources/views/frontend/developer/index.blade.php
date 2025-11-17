
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="shortcut icon" href="{{asset('assets/default_image/developer.jpg') }}">
  <link rel="apple-touch-icon-precomposed" href="{{asset('assets/default_image/developer.jpg') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- Basic Meta Tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="robots" content="index, follow"/>
  <link rel="canonical" href="{{ url()->current() }}"/>
  <meta name="googlebot" content="index, follow">
  <meta name="bingbot" content="index, follow">
    <meta name="publisher" content="Logitech">
  <!-- SEO Meta Tags -->
  <title>Sumoy kuthal - Full Stack Web Developer | Logitech </title>
  <meta name="description" content="Sumoy Kuthal - Full Stack Web Developer | PHP, Laravel, HTML, CSS, Bootstrap, Javascript Expert | This Website Main Developer"/>
  <meta name="keywords" content="Sumoy Kuthal, Full Stack Developer, Web Developer, laravel Developer, Node.js, MongoDB, Logitech Website Developer, Logitech Software Developer, Bangladesh best Laravel developer, Logitech Senior Developer"/>
  <meta name="author" content="Sumoy Kuthal"/>

  <!-- Open Graph / Facebook -->
  <meta property="og:title" content="Sumoy Kuthal - Full Stack Web Developer | Logitech Team"/>
  <meta property="og:description" content="Sumoy Kuthal - Full Stack Web Developer | PHP, Laravel, HTML, CSS, Bootstrap, Javascript Expert"/>
  <meta property="og:image" content="{{asset('assets/default_image/developer.jpg') }}"/>
  <meta property="og:url" content="{{ url()->current() }}"/>
  <meta property="og:type" content="profile"/>
  <meta property="og:locale" content="bn_BD"/>

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image"/>
  <meta name="twitter:title" content="Sumoy Kuthal - Full Stack Web Developer | Logitech Team"/>
  <meta name="twitter:description" content="Sumoy Kuthal, Full Web Developer | PHP, Laravel, HTML, CSS, Bootstrap, Javascript Expert"/>
  <meta name="twitter:image" content="{{asset('assets/default_image/developer.jpg') }}"/>
  <meta name="twitter:site" content="@yourhandle"/>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

  <!-- Structured Data (JSON-LD) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Sumoy Kuthal",
  "jobTitle": "Full Stack Web Developer",
  "image": "https://www.yourwebsite.com/assets/default_image/developer.jpg",
  "url": "https://www.yourwebsite.com/developer",
  "sameAs": [
    "https://github.com/sumoy99",
    "https://linkedin.com/in/sumoy-kuthal-9ba838190",
    "https://twitter.com/sumoykuthal"
  ],
  "worksFor": {
    "@type": "Organization",
    "name": "Logitech Website"
  },
  "alumniOf": {
    "@type": "CollegeOrUniversity",
    "name": "Pabna Polytechnic Institute"
  },
  "knowsAbout": [
    "Web Development", 
    "Laravel", 
    "PHP", 
    "HTML", 
    "JavaScript", 
    "CSS", 
    "Bootstrap"
  ],
  "description": "Sumoy Kuthal is a passionate Full Stack Web Developer with expertise in Laravel, PHP, and modern web technologies. He is the lead developer of Logitech Website.",
  "inLanguage": "en"
}
</script>

  <!-- Custom CSS -->
  <style>
    :root {
      --bg-dark: #0f0f1a;
      --card-bg: #1a1a2e;
      --text-light: #e0e0e0;
      --text-muted: #a0a0c0;
      --accent: #00d4ff;
      --accent-hover: #00b0d4;
      --border: #33334d;
    }

    body {
      background: linear-gradient(135deg, #0f0f1a 0%, #16213e 100%);
      color: var(--text-light);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      padding: 40px 0;
    }

    .developer-card {
      background: var(--card-bg);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
      border: 1px solid var(--border);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .developer-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 60px rgba(0, 212, 255, 0.15);
    }

    .profile-img {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid var(--accent);
      box-shadow: 0 0 30px rgba(0, 212, 255, 0.3);
      transition: all 0.3s ease;
    }

    .profile-img:hover {
      transform: scale(1.05);
      box-shadow: 0 0 40px rgba(0, 212, 255, 0.5);
    }

    .name {
      font-size: 2rem;
      font-weight: 700;
      background: linear-gradient(90deg, #00d4ff, #00aaff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .position {
      color: var(--accent);
      font-weight: 500;
      letter-spacing: 1px;
    }

    .bio {
      color: var(--text-muted);
      line-height: 1.8;
      font-size: 1rem;
    }

    .skills {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 15px;
    }

    .skill-tag {
      background: rgba(0, 212, 255, 0.15);
      color: var(--accent);
      padding: 6px 14px;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 500;
      border: 1px solid rgba(0, 212, 255, 0.3);
      transition: all 0.3s ease;
    }

    .skill-tag:hover {
      background: var(--accent);
      color: #000;
      transform: translateY(-2px);
    }

    .social-links a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 45px;
      height: 45px;
      background: rgba(0, 212, 255, 0.1);
      color: var(--accent);
      border-radius: 50%;
      font-size: 1.2rem;
      margin: 0 8px;
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 212, 255, 0.3);
    }

    .social-links a:hover {
      background: var(-- accent);
      color: #000;
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 212, 255, 0.3);
    }

    .section-title {
      position: relative;
      display: inline-block;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 50px;
      height: 3px;
      background: var(--accent);
      border-radius: 2px;
    }

    .container {
      max-width: 1000px;
    }

    @media (max-width: 768px) {
      .profile-img {
        width: 140px;
        height: 140px;
      }
      .name {
        font-size: 1.6rem;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <div class="developer-card p-5">

          <!-- Profile Header -->
          <div class="text-center mb-5">
            <img src="{{asset('assets/default_image/developer.jpg') }}" alt="Developer Photo" class="profile-img mb-4"/>
            <h1 class="name">Sumoy Kuthal</h1>
            <p class="position text-uppercase">Full Stack Web Developer</p>
          </div>

          <!-- About -->
          <div class="mb-5">
            <h4 class="section-title">About Developer</h4>
            <p class="bio">
              Sumoy Kuthal, a Software Programmer at Logitech Group, blends software development with curiosity and creativity. He believes great software is not just about code — it’s about crafting experiences that simplify life and inspire innovation.
            </p>
          </div>

          <!-- Skills -->
          <div class="mb-5">
            <h4 class="section-title">Skills & Expertise</h4>
            <div class="skills">
              <span class="skill-tag">HTML5</span>
              <span class="skill-tag">CSS3</span>
              <span class="skill-tag">Bootstrap</span>
              <span class="skill-tag">JavaScript</span>
              <span class="skill-tag">PHP</span>
              <span class="skill-tag">Laravel*</span>
              <span class="skill-tag">Git & GitHub</span>
              <span class="skill-tag">REST API</span>
            </div>
          </div>

          <!-- Social Links -->
          <div class="text-center">
            <h4 class="section-title d-inline-block">Connect With The Developer</h4>
            <div class="social-links mt-4">
              <a href="https://github.com/sumoy99" title="Github" target="_blank"><i class="bi bi-github"></i></a>
              <a href="https://linkedin.com/in/sumoy-kuthal-9ba838190" title="Linkedin" target="_blank"><i class="bi bi-linkedin"></i></a>
              <a href="https://twitter.com/sumoykuthal" title="Twitter" target="_blank"><i class="bi bi-twitter"></i></a>
              <a href="#" title="Facebook" target="_blank"><i class="bi bi-facebook"></i></a>
              <a href="sumoykuthal@gmail.com" title="Mail" target="_blank"><i class="bi bi-envelope"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"/>

  <!-- Bootstrap JS (Optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

