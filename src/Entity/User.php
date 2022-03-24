<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $institutionName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $businessAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobilePhone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isWaitingCertificate = false;

    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="users")
     */
    private $speciality;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAttendingMeeting;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isRemotely;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isNeedTrain;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isNeedFlight;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isNeedHotel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trainStation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $airport;


    // ====================================================== //
    // =================== GETTERS/SETTERS ================== //
    // ====================================================== //

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = strtolower($email);

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        
        $this->name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = mb_convert_case($firstname, MB_CASE_TITLE, "UTF-8");;

        return $this;
    }

    public function getInstitutionName(): ?string
    {
        return $this->institutionName;
    }

    public function setInstitutionName(string $institutionName): self
    {
        $this->institutionName = $institutionName;

        return $this;
    }

    public function getBusinessAddress(): ?string
    {
        return $this->businessAddress;
    }

    public function setBusinessAddress(string $businessAddress): self
    {
        $this->businessAddress = $businessAddress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getIsWaitingCertificate(): ?bool
    {
        return $this->isWaitingCertificate;
    }

    public function setIsWaitingCertificate(bool $isWaitingCertificate): self
    {
        $this->isWaitingCertificate = $isWaitingCertificate;

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getIsAttendingMeeting(): ?bool
    {
        return $this->isAttendingMeeting;
    }

    public function setIsAttendingMeeting(?bool $isAttendingMeeting): self
    {
        $this->isAttendingMeeting = $isAttendingMeeting;

        return $this;
    }

    public function getIsRemotely(): ?bool
    {
        return $this->isRemotely;
    }

    public function setIsRemotely(?bool $isRemotely): self
    {
        $this->isRemotely = $isRemotely;

        return $this;
    }

    public function getIsNeedTrain(): ?bool
    {
        return $this->isNeedTrain;
    }

    public function setIsNeedTrain(?bool $isNeedTrain): self
    {
        $this->isNeedTrain = $isNeedTrain;

        return $this;
    }

    public function getIsNeedFlight(): ?bool
    {
        return $this->isNeedFlight;
    }

    public function setIsNeedFlight(?bool $isNeedFlight): self
    {
        $this->isNeedFlight = $isNeedFlight;

        return $this;
    }

    public function getIsNeedHotel(): ?bool
    {
        return $this->isNeedHotel;
    }

    public function setIsNeedHotel(?bool $isNeedHotel): self
    {
        $this->isNeedHotel = $isNeedHotel;

        return $this;
    }

    public function getTrainStation(): ?string
    {
        return $this->trainStation;
    }

    public function setTrainStation(?string $trainStation): self
    {
        $this->trainStation = $trainStation;

        return $this;
    }

    public function getAirport(): ?string
    {
        return $this->airport;
    }

    public function setAirport(?string $airport): self
    {
        $this->airport = $airport;

        return $this;
    }
}
