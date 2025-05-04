def fonction(n):
    l = []  # liste des diviseurs
    m = []  # liste des diviseurs propres (sans n lui-même)
    s = 0
    
    # Trouver tous les diviseurs
    for k in range(1, n+1):
        if n % k == 0:
            l.append(k)
    
    # Trouver les diviseurs propres
    for k in range(1, n):
        if n % k == 0:
            m.append(k)
    # Calcul de la somme des inverses des diviseurs propres
    for k in range(1, len(l)):
        s += 1/l[k]
    
    # Vérifier si c'est un nombre parfait
    if s == n:
        return True, s, l
    else:
        return False, s, l

# Test avec le nombre n = 28
n = 30
resultat, s, diviseurs = fonction(n)
print(f"Est-ce que {n} est parfait? {resultat} avec pour diviseurs {diviseurs} et pour somme des diviseurs propres {s}")
