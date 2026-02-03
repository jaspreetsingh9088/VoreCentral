<div class="form-row">
  <div class="left-group">
    <input type="text" placeholder="Search...">
    <button type="submit">Search</button>
    @php
    $selectedType = request()->get('type', 'All');
    $selectedOrder = request()->get('order', 'latest');
    @endphp
    <form action="{{ route('publicstore.search') }}" method="GET">

      <select name="type" id="store_content_type">
        <option value="All" {{ $selectedType == 'All' ? 'selected' : '' }}>All</option>
        <option value="Image" {{ $selectedType == 'Image' ? 'selected' : '' }}>Image</option>
        <option value="Comics" {{ $selectedType == 'Comics' ? 'selected' : '' }}>Comics</option>
        <option value="Video" {{ $selectedType == 'Video' ? 'selected' : '' }}>Video</option>
        <option value="Audio" {{ $selectedType == 'Audio' ? 'selected' : '' }}>Audio</option>
        <option value="Text" {{ $selectedType == 'Text' ? 'selected' : '' }}>Text</option>
      </select>

      <select name="order" class="form-select" id="order_filter">
          <option value="latest" {{ $selectedOrder === 'latest' ? 'selected' : '' }}>Latest</option>
          <option value="recency" {{ $selectedOrder === 'recency' ? 'selected' : '' }}>Prioritise Recency</option>
          <option value="relevancy" {{ $selectedOrder === 'relevancy' ? 'selected' : '' }}>Prioritise Relevancy</option>
          <option value="prioritiseTags" {{ $selectedOrder === 'prioritiseTags' ? 'selected' : '' }}>Prioritise My Tags</option>
          <option value="prioritisePopularity" {{ $selectedOrder === 'prioritisePopularity' ? 'selected' : '' }}>Prioritise Popularity</option>
      </select>
    </form>

  </div>
  <div class="right-group" style="color: #fff;">
    <a href="{{ route('browsecreator') }}">
      <button>Creator</button></a>
    <a href="{{ route('random') }}" style="color: #fff;">
      <button>Random</button></a>


  </div>
</div>


<script>
  document.getElementById('order_filter').addEventListener('change', function () {
    this.form.submit();
  });
  document.getElementById('type_filter').addEventListener('change', function() {
    let orderFilter = document.getElementById('order_filter').value || 'latest'; // Default to 'latest' if empty
    if (this.value) {
      let updatedUrl = this.value.replace('latest', orderFilter); // Replace 'latest' with selected sorting
      window.location.href = updatedUrl;
    }
  });

  document.getElementById('order_filter').addEventListener('change', function() {
    let orderFilter1 = document.getElementById('type_filter').value;
    if (orderFilter1) {
      let updatedUrl = orderFilter1.replace(/(featured|recency|relevancy|prioritisePopularity|prioritiseTags|latest)/, this.value || 'latest'); // Replace sorting value
      window.location.href = updatedUrl;
    }
  });

  function preselectValues() {
    let currentUrl = window.location.href;
    let type_filter = document.getElementById('type_filter');
    let orderFilter = document.getElementById('order_filter');

    let urlParts = currentUrl.split('/publicgallery/')[1]?.split('/') || [];
    let selectedCategory = urlParts[0];
    let selectedSorting = urlParts[1] || 'latest';
    document.getElementById('type').value = selectedCategory.replace(/s/g, '');
    document.getElementById('order').value = selectedSorting;

    orderFilter.value = selectedSorting;

    for (let option of type_filter.options) {
      if (option.value.includes(selectedCategory)) {
        type_filter.value = option.value;
        break;
      }
    }
  }

  window.onload = preselectValues;
</script>