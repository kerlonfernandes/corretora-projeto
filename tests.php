<!-- Include stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />

<!-- Create the editor container -->
<div id="editor">

</div>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });

  // Event listener for text change
  quill.on('text-change', function() {
    const content = quill.root.innerHTML;
    console.log(content);
    // You can now use the 'content' variable as needed
  });
</script>
