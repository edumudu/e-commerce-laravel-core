<h1>O pagamento para o seguites produtos foi aprovado</h1>
<span>Reference: {{ $reference }}</span>
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