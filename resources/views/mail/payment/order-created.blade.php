<h1>Successful requested your order {{ $user['name'] }}</h1>

<ul>
  @foreach ($items as $item)
    <li>
      <h3>{{ $item->name }}</h3>
      <div>
        <span>Quantity: {{ $item->quantity }}</span>

        <br />
        
        <span>Price: {{ $item->price }}</span>
      </div>
    </li>
  @endforeach
</ul>