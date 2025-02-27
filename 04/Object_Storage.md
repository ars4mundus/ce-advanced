사전 준비
- Samsung Cloud Platform 내 Object Storage Bucket 구성

  Bucket 이름, Public Endpoint, 인증키(access key, access secret key) 

- Samsung Cloud Platfrom 내 Linux Virtual Server 구성(CentOS)

- Azure Storage Account 내 Object Storage를 위한 컨테이너 구성

  Storage Account 이름, Access key, 컨테이너 이름

<h1>Object Storage Migration</h1>

<h3>Rclone 설치</h3>

```bash
curl https://rclone.org/install.sh | sudo bash  // 기타 Linux
```

<h3>Azure Rclone Remote 구성</h3>

```bash
rclone config
```
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/b150088f-24d7-4311-8649-09c14a2f4c28><br>
n을 입력하여 신규 Remote를 생성<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/965e2a76-4a3e-453a-8500-efdba34583ea><br>
신규 Remote의 이름 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/bec1d8ea-f6b3-4825-994f-cbdbb56fd2cd><br>
Microsoft Azure Blob Storage를 선택<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c9d7bc0a-af18-414d-910b-9488bec1b6ab><br>
연결할 Blob Storage의 Storage Account를 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/89809ea5-90f0-4754-bc1c-2e1b0751c21f><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c30bfef6-23ff-4cf5-8c2b-c878e2ece17d><br>
Azure의 Storage Account의 액세스 키 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/e21c548c-9a69-49c9-9766-0809a9f5dc14><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/41868a2f-1a97-47a6-b04c-5c8d961ed7c9><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/2847357a-2774-47f0-86be-68cb980dd54a><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/31a96583-7321-4cba-a940-9c572f7248b7><br>
입력하지 않은 채로 default 설정을 위해 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d10a9b6d-53d7-4d14-ac16-ff1dbb54271d><br>
입력 정보 확인 후 맞다면 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/af13d55c-8255-458f-b56e-91e24902d8f5><br>
생성된 Azure Blob의 Remote 확인<br>

<h3>구성된 Rclone 확인</h3>

```bash
rclone ls [config name]:[bucket name]
```
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/d9d2cbf6-2fb8-4de1-800a-5154bdb85e9b><br>
명령어 입력으로 확인할 경우 사진과 같이 bucket 내부의 Object를 출력합니다.

<h3>Samsung Cloud Platform Rclone Remote 구성</h3>

```bash
rclone config
```
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/fc9635ba-841a-4da9-9171-88aaf3d29705><br>
n을 입력하여 신규 Remote를 생성<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/75f86cef-385e-4518-8977-2fac818b961c><br>
Remote의 이름을 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/26c427ff-6a87-487f-b108-87284f0323c2><br>
Amazone S3 Compliant Storage를 선택<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/85fd890a-cc71-4da4-9be2-ab3dd76e7c19><br>
Any other S3 compatible Provider를 선택<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4af3c432-7c95-4b8c-aa71-e10f5ab7a5bf><br>
입력하지 않고 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f1f2cbb0-d4e3-48b1-ac90-aa1bb3246220><br>
Samsung Cloud Platform Object Storage의 Access key와 Secret key를 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4e2e1b1b-3aa6-4486-9f99-2a83571eff88><br>
입력하지 않고 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c5b05847-c458-47e4-a85a-f42671e4bae6><br>
Samsung Cloud Platform Object Storage의 Endpoint 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/4c5ad4df-dccf-4893-afa0-b212f95d1795><br>
입력하지 않고 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/f792fc5d-d7f2-4934-a971-a0c4f1a55f14><br>
Private 선택<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/033f1e48-97c4-4693-8db0-a6fc62d2262e><br>
입력하지 않고 Enter 입력<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/896cb876-07d7-45d2-875f-2e491c97d4b0><br>
생성된 Samsung Cloud Platform Object Storage의 Remote를 확인<br>
<img src=https://github.com/scp-cloudacademy/ce-advanced/assets/147478897/c109a14e-20d2-49c9-9a18-2afc9cbdbe2a><br>
명령어 입력으로 확인할 경우 스크린샷과 같이 Bucket 정보를 확인할 수 있습니다.

<h3>Migration 수행</h3>

```bash
rclone sync [source config name]:[bucket] [target config name]:[bucket] --dry-run --progress
rclone sync [source config name]:[bucket] [target config name]:[bucket] --progress
```
