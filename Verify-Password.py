import hashlib
import requests

password = input("Digite a senha: ")

sha1hash = hashlib.sha1(password.encode('utf-8')).hexdigest().upper()
hash_prefix = sha1hash[:5]
response = requests.get(f'https://api.pwnedpasswords.com/range/{hash_prefix}')
if response.status_code != 200:
    raise RuntimeError('Não foi possível acessar a API do Have I Been Pwned.')
suffixes = (line.split(':') for line in response.text.splitlines())
count = next((int(count) for suffix, count in suffixes if sha1hash[5:] == suffix), 0)
if count:
    print(f'A senha foi vazada em {count} vazamentos conhecidos. Por favor, escolha outra senha.')
else:
    print('A senha não foi encontrada em vazamentos conhecidos.') 