</main> <!-- closes .container -->

<?php
// This ensures BASE_URL is available if the footer is used in a context where it's not already loaded.
if (!defined('BASE_URL')) {
    require_once(dirname(__FILE__).'/../config/database.php');
}
?>
<footer class="main-footer" style="background: #333; color: #fff; padding: 2rem 1rem; text-align: center; margin-top: 2rem;">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Igreja Batista. Todos os direitos reservados.</p>
        <p>
            <a href="<?php echo BASE_URL; ?>/public/admin" style="color: #fff;">Admin Login</a>
        </p>
    </div>
</footer>

<script>
    // Simple mobile navigation toggle
    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', () => {
            mainNav.style.display = mainNav.style.display === 'block' ? 'none' : 'block';
        });
    }
</script>

</body>
</html>
