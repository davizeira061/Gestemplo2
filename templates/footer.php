</main> <!-- closes .container -->

<footer class="main-footer" style="background: #333; color: #fff; padding: 2rem 1rem; text-align: center; margin-top: 2rem;">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Igreja Batista. Todos os direitos reservados.</p>
        <p>
            <a href="/pib-clone/public/admin" style="color: #fff;">Admin Login</a>
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
